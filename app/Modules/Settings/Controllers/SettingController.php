<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Settings\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\Currencies\Repositories\CurrencyRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Invoices\Support\InvoiceTemplates;
use FI\Modules\MailQueue\Support\MailSettings;
use FI\Modules\PaymentMethods\Repositories\PaymentMethodRepository;
use FI\Modules\Quotes\Support\QuoteTemplates;
use FI\Modules\Settings\Repositories\SettingRepository;
use FI\Modules\Settings\Validators\SettingValidator;
use FI\Modules\TaxRates\Repositories\TaxRateRepository;
use FI\Support\DashboardWidgets;
use FI\Support\DateFormatter;
use FI\Support\Languages;
use FI\Support\Logo;
use FI\Support\PDF\PDFFactory;
use FI\Support\Skins;
use FI\Support\UpdateChecker;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
    private $companyProfileRepository;
    private $currencyRepository;
    private $groupRepository;
    private $paymentMethodRepository;
    private $settingRepository;
    private $settingValidator;
    private $taxRateRepository;

    public function __construct(
        CompanyProfileRepository $companyProfileRepository,
        CurrencyRepository $currencyRepository,
        GroupRepository $groupRepository,
        PaymentMethodRepository $paymentMethodRepository,
        SettingRepository $settingRepository,
        SettingValidator $settingValidator,
        TaxRateRepository $taxRateRepository
    )
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->currencyRepository       = $currencyRepository;
        $this->groupRepository          = $groupRepository;
        $this->paymentMethodRepository  = $paymentMethodRepository;
        $this->settingRepository        = $settingRepository;
        $this->settingValidator         = $settingValidator;
        $this->taxRateRepository        = $taxRateRepository;
    }

    public function index()
    {
        try
        {
            Crypt::decrypt(config('fi.mailPassword'));
            session()->forget('error');
        }
        catch (\Exception $e)
        {
            // Do nothing, already done in Config Provider
        }

        return view('settings.index')
            ->with([
                'languages'               => Languages::listLanguages(),
                'dateFormats'             => DateFormatter::dropdownArray(),
                'invoiceTemplates'        => InvoiceTemplates::lists(),
                'quoteTemplates'          => QuoteTemplates::lists(),
                'groups'                  => $this->groupRepository->lists(),
                'taxRates'                => $this->taxRateRepository->lists(),
                'paymentMethods'          => $this->paymentMethodRepository->lists(),
                'emailSendMethods'        => MailSettings::listSendMethods(),
                'emailEncryptions'        => MailSettings::listEncryptions(),
                'yesNoArray'              => ['0' => trans('fi.no'), '1' => trans('fi.yes')],
                'timezones'               => array_combine(timezone_identifiers_list(), timezone_identifiers_list()),
                'invoiceLogoImg'          => Logo::getImg(200),
                'paperSizes'              => ['letter' => trans('fi.letter'), 'A4' => trans('fi.a4'), 'legal' => trans('fi.legal')],
                'paperOrientations'       => ['portrait' => trans('fi.portrait'), 'landscape' => trans('fi.landscape')],
                'currencies'              => $this->currencyRepository->lists(),
                'exchangeRateModes'       => ['automatic' => trans('fi.automatic'), 'manual' => trans('fi.manual')],
                'pdfDrivers'              => PDFFactory::getDrivers(),
                'convertQuoteOptions'     => ['quote' => trans('fi.convert_quote_option1'), 'invoice' => trans('fi.convert_quote_option2')],
                'clientUniqueNameOptions' => ['0' => trans('fi.client_unique_name_option_1'), '1' => trans('fi.client_unique_name_option_2')],
                'dashboardWidgets'        => DashboardWidgets::listsByOrder(),
                'colWidthArray'           => array_combine(range(1, 12), range(1, 12)),
                'displayOrderArray'       => array_combine(range(1, 24), range(1, 24)),
                'merchant'                => config('fi.merchant'),
                'skins'                   => Skins::lists(),
                'resultsPerPage'          => array_combine(range(15, 100, 5), range(15, 100, 5)),
                'merchantCcOptions'       => ['0' => trans('fi.do_not_display'), '1' => trans('fi.display_do_not_require'), '2' => trans('fi.require')],
                'amountDecimalOptions'    => ['0' => '0', '2' => '2', '3' => '3', '4' => '4'],
                'roundTaxDecimalOptions'  => ['2' => '2', '3' => '3', '4' => '4'],
                'companyProfiles'         => $this->companyProfileRepository->lists(),
            ]);
    }

    public function update()
    {
        $validator = $this->settingValidator->getValidator(request('setting'));

        if ($validator->fails())
        {
            return redirect()->route('settings.index')
                ->withErrors($validator)
                ->withInput();
        }

        foreach (request('setting') as $key => $value)
        {
            $skipSave = false;

            if ($key == 'mailPassword' and $value)
            {
                $value = Crypt::encrypt($value);
            }
            elseif ($key == 'mailPassword' and !$value)
            {
                $skipSave = true;
            }

            if ($key == 'merchant')
            {
                $value = json_encode($value);
            }

            if (!$skipSave)
            {
                $this->settingRepository->save($key, $value);
            }
        }

        if (request()->hasFile('logo'))
        {
            $ext = request()->file('logo')->getClientOriginalExtension();

            request()->file('logo')->move(storage_path(), 'logo.' . $ext);

            $this->settingRepository->save('logo', 'logo.' . $ext);
        }

        $this->settingRepository->writeEmailTemplates();

        return redirect()->route('settings.index')
            ->with('alertSuccess', trans('fi.settings_successfully_saved'));
    }

    public function logoDelete()
    {
        Logo::delete();

        $this->settingRepository->delete('logo');

        return redirect()->route('settings.index');
    }

    public function updateCheck()
    {
        $updateChecker = new UpdateChecker;

        $updateAvailable = $updateChecker->updateAvailable();
        $currentVersion  = $updateChecker->getCurrentVersion();

        if ($updateAvailable)
        {
            $message = trans('fi.update_available', ['version' => $currentVersion]);
        }
        else
        {
            $message = trans('fi.update_not_available');
        }

        return response()->json(
            [
                'success' => true,
                'message' => $message,
            ], 200
        );
    }

    public function saveTab()
    {
        session(['settingTabId' => request('settingTabId')]);
    }
}
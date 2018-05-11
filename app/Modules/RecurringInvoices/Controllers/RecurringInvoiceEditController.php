<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\RecurringInvoices\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Currencies\Repositories\CurrencyRepository;
use FI\Modules\CustomFields\Repositories\CustomFieldRepository;
use FI\Modules\Invoices\Support\InvoiceTemplates;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceRepository;
use FI\Modules\RecurringInvoices\Validators\RecurringInvoiceValidator;
use FI\Modules\TaxRates\Repositories\TaxRateRepository;
use FI\Support\Frequency;
use FI\Traits\ReturnUrl;
use FI\Validators\ItemValidator;

class RecurringInvoiceEditController extends Controller
{
    use ReturnUrl;

    private $taxRateRepository;
    private $itemValidator;
    private $recurringInvoiceValidator;
    private $recurringInvoiceRepository;
    private $customFieldRepository;
    private $currencyRepository;

    public function __construct(
        CurrencyRepository $currencyRepository,
        CustomFieldRepository $customFieldRepository,
        RecurringInvoiceRepository $recurringInvoiceRepository,
        RecurringInvoiceValidator $recurringInvoiceValidator,
        ItemValidator $itemValidator,
        TaxRateRepository $taxRateRepository
    )
    {
        $this->currencyRepository         = $currencyRepository;
        $this->customFieldRepository      = $customFieldRepository;
        $this->recurringInvoiceRepository = $recurringInvoiceRepository;
        $this->recurringInvoiceValidator  = $recurringInvoiceValidator;
        $this->itemValidator              = $itemValidator;
        $this->taxRateRepository          = $taxRateRepository;
    }

    public function edit($id)
    {
        $recurringInvoice = $this->recurringInvoiceRepository->with(['items.amount.item.recurringInvoice.currency'])->find($id);

        return view('recurring_invoices.edit')
            ->with('recurringInvoice', $recurringInvoice)
            ->with('currencies', $this->currencyRepository->lists())
            ->with('taxRates', $this->taxRateRepository->lists())
            ->with('customFields', $this->customFieldRepository->getByTable('recurring_invoices'))
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', InvoiceTemplates::lists())
            ->with('itemCount', count($recurringInvoice->recurringInvoiceItems))
            ->with('frequencies', Frequency::lists());
    }

    public function update($id)
    {
        $validator = $this->recurringInvoiceValidator->getUpdateValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

        foreach (json_decode(request('items')) as $item)
        {
            $itemValidator = $this->itemValidator->getValidator($item);

            if ($itemValidator->fails())
            {
                return response()->json([
                    'success' => false,
                    'errors'  => $itemValidator->messages()->toArray(),
                ], 400);
            }
        }

        $this->recurringInvoiceRepository->update(request()->all(), $id);

        return response()->json(['success' => true], 200);
    }

    public function refreshEdit($id)
    {
        $recurringInvoice = $this->recurringInvoiceRepository->with(['items.amount.item.recurringInvoice.currency'])->find($id);

        return view('recurring_invoices._edit')
            ->with('recurringInvoice', $recurringInvoice)
            ->with('currencies', $this->currencyRepository->lists())
            ->with('taxRates', $this->taxRateRepository->lists())
            ->with('customFields', $this->customFieldRepository->getByTable('recurring_invoices'))
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', InvoiceTemplates::lists())
            ->with('itemCount', count($recurringInvoice->recurringInvoiceItems))
            ->with('frequencies', Frequency::lists());
    }

    public function refreshTotals()
    {
        return view('recurring_invoices._edit_totals')
            ->with('recurringInvoice', $this->recurringInvoiceRepository->with(['items.amount.item.recurringInvoice.currency'])->find(request('id')));
    }

    public function refreshTo()
    {
        return view('recurring_invoices._edit_to')
            ->with('recurringInvoice', $this->recurringInvoiceRepository->find(request('id')));
    }

    public function refreshFrom()
    {
        return view('recurring_invoices._edit_from')
            ->with('recurringInvoice', $this->recurringInvoiceRepository->find(request('id')));
    }

    public function updateClient()
    {
        $this->recurringInvoiceRepository->updateRaw(['client_id' => request('client_id')], request('id'));
    }

    public function updateCompanyProfile()
    {
        $this->recurringInvoiceRepository->updateRaw(['company_profile_id' => request('company_profile_id')], request('id'));
    }
}
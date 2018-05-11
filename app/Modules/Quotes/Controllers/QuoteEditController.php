<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Currencies\Repositories\CurrencyRepository;
use FI\Modules\CustomFields\Repositories\CustomFieldRepository;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Modules\Quotes\Repositories\QuoteRepository;
use FI\Modules\Quotes\Support\QuoteTemplates;
use FI\Modules\Quotes\Validators\QuoteValidator;
use FI\Modules\TaxRates\Repositories\TaxRateRepository;
use FI\Support\Statuses\QuoteStatuses;
use FI\Traits\ReturnUrl;
use FI\Validators\ItemValidator;

class QuoteEditController extends Controller
{
    use ReturnUrl;

    private $currencyRepository;
    private $customFieldRepository;
    private $itemValidator;
    private $quoteRepository;
    private $quoteValidator;
    private $taxRateRepository;

    public function __construct(
        CurrencyRepository $currencyRepository,
        CustomFieldRepository $customFieldRepository,
        ItemValidator $itemValidator,
        InvoiceRepository $invoiceRepository,
        QuoteRepository $quoteRepository,
        QuoteValidator $quoteValidator,
        TaxRateRepository $taxRateRepository
    )
    {
        $this->currencyRepository    = $currencyRepository;
        $this->customFieldRepository = $customFieldRepository;
        $this->itemValidator         = $itemValidator;
        $this->quoteRepository       = $quoteRepository;
        $this->invoiceRepository     = $invoiceRepository;
        $this->quoteValidator        = $quoteValidator;
        $this->taxRateRepository     = $taxRateRepository;
    }

    public function edit($id)
    {
        $quote = $this->quoteRepository->with(['items.amount.item.quote.currency'])->find($id);

        return view('quotes.edit')
            ->with('quote', $quote)
            ->with('invoice', $this->invoiceRepository->find($quote->id))
            ->with('statuses', QuoteStatuses::lists())
            ->with('currencies', $this->currencyRepository->lists())
            ->with('taxRates', $this->taxRateRepository->lists())
            ->with('customFields', $this->customFieldRepository->getByTable('quotes'))
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', QuoteTemplates::lists())
            ->with('itemCount', count($quote->quoteItems));
    }

    public function update($id)
    {
        $validator = $this->quoteValidator->getUpdateValidator(request()->all());

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

        $this->quoteRepository->update(request()->all(), $id);

        return response()->json(['success' => true], 200);
    }

    public function refreshEdit($id)
    {
        $quote = $this->quoteRepository->with(['items.amount.item.quote.currency'])->find($id);

        return view('quotes._edit')
            ->with('quote', $quote)
            ->with('statuses', QuoteStatuses::lists())
            ->with('currencies', $this->currencyRepository->lists())
            ->with('taxRates', $this->taxRateRepository->lists())
            ->with('customFields', $this->customFieldRepository->getByTable('quotes'))
            ->with('returnUrl', $this->getReturnUrl())
            ->with('templates', QuoteTemplates::lists())
            ->with('itemCount', count($quote->quoteItems));
    }

    public function refreshTotals()
    {
        return view('quotes._edit_totals')
            ->with('quote', $this->quoteRepository->with(['items.amount.item.quote.currency'])->find(request('id')));
    }

    public function refreshTo()
    {
        return view('quotes._edit_to')
            ->with('quote', $this->quoteRepository->find(request('id')));
    }

    public function refreshFrom()
    {
        return view('quotes._edit_from')
            ->with('quote', $this->quoteRepository->find(request('id')));
    }

    public function updateClient()
    {
        $this->quoteRepository->updateRaw(['client_id' => request('client_id')], request('id'));
    }

    public function updateCompanyProfile()
    {
        $this->quoteRepository->updateRaw(['company_profile_id' => request('company_profile_id')], request('id'));
    }
}
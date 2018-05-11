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
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\Quotes\Repositories\QuoteRepository;
use FI\Support\FileNames;
use FI\Support\PDF\PDFFactory;
use FI\Support\Statuses\QuoteStatuses;
use FI\Traits\ReturnUrl;

class QuoteController extends Controller
{
    use ReturnUrl;

    private $companyProfileRepository;
    private $quoteRepository;

    public function __construct(CompanyProfileRepository $companyProfileRepository, QuoteRepository $quoteRepository)
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->quoteRepository          = $quoteRepository;
    }

    public function index()
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');

        $quotes = $this->quoteRepository->with(['client', 'activities', 'amount.quote.currency', 'invoice'])
            ->paginateByStatus($status, request('search'), request('client'), request('company_profile'));

        return view('quotes.index')
            ->with('quotes', $quotes)
            ->with('status', $status)
            ->with('statuses', QuoteStatuses::listsAllFlat())
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + $this->companyProfileRepository->lists())
            ->with('displaySearch', true);
    }

    public function delete($id)
    {
        $this->quoteRepository->delete($id);

        return redirect()->route('quotes.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }

    public function pdf($id)
    {
        $quote = $this->quoteRepository->find($id);

        $pdf = PDFFactory::create();

        $pdf->download($quote->html, FileNames::quote($quote));
    }
}
<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Support\FileNames;
use FI\Support\PDF\PDFFactory;
use FI\Support\Statuses\InvoiceStatuses;
use FI\Traits\ReturnUrl;

class InvoiceController extends Controller
{
    use ReturnUrl;

    private $companyProfileRepository;
    private $invoiceRepository;

    public function __construct(CompanyProfileRepository $companyProfileRepository, InvoiceRepository $invoiceRepository)
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->invoiceRepository        = $invoiceRepository;
    }

    public function index()
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');

        $invoices = $this->invoiceRepository->with(['client', 'activities', 'amount.invoice.currency'])
            ->paginateByStatus($status, request('search'), request('client'), request('company_profile'));

        return view('invoices.index')
            ->with('invoices', $invoices)
            ->with('status', $status)
            ->with('statuses', InvoiceStatuses::listsAllFlat() + ['overdue' => trans('fi.overdue')])
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + $this->companyProfileRepository->lists())
            ->with('displaySearch', true);
    }

    public function delete($id)
    {
        $this->invoiceRepository->delete($id);

        return redirect()->route('invoices.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }

    public function pdf($id)
    {
        $invoice = $this->invoiceRepository->find($id);

        $pdf = PDFFactory::create();

        $pdf->download($invoice->html, FileNames::invoice($invoice));
    }
}
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
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Invoices\Repositories\InvoiceCopyRepository;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Modules\Invoices\Validators\InvoiceValidator;
use FI\Support\DateFormatter;

class InvoiceCopyController extends Controller
{
    private $companyProfileRepository;
    private $groupRepository;
    private $invoiceCopyRepository;
    private $invoiceRepository;
    private $invoiceValidator;

    public function __construct(
        CompanyProfileRepository $companyProfileRepository,
        GroupRepository $groupRepository,
        InvoiceCopyRepository $invoiceCopyRepository,
        InvoiceRepository $invoiceRepository,
        InvoiceValidator $invoiceValidator
    )
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->groupRepository          = $groupRepository;
        $this->invoiceCopyRepository    = $invoiceCopyRepository;
        $this->invoiceRepository        = $invoiceRepository;
        $this->invoiceValidator         = $invoiceValidator;
    }

    public function create()
    {
        $invoice = $this->invoiceRepository->find(request('invoice_id'));

        return view('invoices._modal_copy')
            ->with('invoice', $invoice)
            ->with('groups', $this->groupRepository->lists())
            ->with('companyProfiles', $this->companyProfileRepository->lists())
            ->with('created_at', DateFormatter::format())
            ->with('user_id', auth()->user()->id);
    }

    public function store()
    {
        $validator = $this->invoiceValidator->getValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

        $invoiceId = $this->invoiceCopyRepository->copyInvoice(
            request('invoice_id'),
            request('client_name'),
            DateFormatter::unformat(request('created_at')),
            DateFormatter::incrementDateByDays(DateFormatter::unformat(request('created_at')), config('fi.invoicesDueAfter')),
            request('group_id'),
            auth()->user()->id,
            request('company_profile_id'))->id;

        return response()->json(['success' => true, 'id' => $invoiceId], 200);
    }
}
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
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceCopyRepository;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceRepository;
use FI\Modules\RecurringInvoices\Validators\RecurringInvoiceValidator;
use FI\Support\DateFormatter;
use FI\Support\Frequency;

class RecurringInvoiceCopyController extends Controller
{
    private $companyProfileRepository;
    private $groupRepository;
    private $recurringInvoiceCopyRepository;
    private $recurringInvoiceRepository;
    private $recurringInvoiceValidator;

    public function __construct(
        CompanyProfileRepository $companyProfileRepository,
        GroupRepository $groupRepository,
        RecurringInvoiceCopyRepository $recurringInvoiceCopyRepository,
        RecurringInvoiceRepository $recurringInvoiceRepository,
        RecurringInvoiceValidator $recurringInvoiceValidator
    )
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->groupRepository          = $groupRepository;
        $this->recurringInvoiceCopyRepository    = $recurringInvoiceCopyRepository;
        $this->recurringInvoiceRepository        = $recurringInvoiceRepository;
        $this->recurringInvoiceValidator         = $recurringInvoiceValidator;
    }

    public function create()
    {
        $recurringInvoice = $this->recurringInvoiceRepository->find(request('recurring_invoice_id'));

        return view('recurring_invoices._modal_copy')
            ->with('recurringInvoice', $recurringInvoice)
            ->with('groups', $this->groupRepository->lists())
            ->with('companyProfiles', $this->companyProfileRepository->lists())
            ->with('frequencies', Frequency::lists());
    }

    public function store()
    {
        $validator = $this->recurringInvoiceValidator->getValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

        $recurringInvoiceId = $this->recurringInvoiceCopyRepository->copyRecurringInvoice(
            request('recurring_invoice_id'),
            request('client_name'),
            request('group_id'),
            auth()->user()->id,
            request('company_profile_id'),
            request('recurring_frequency'),
            request('recurring_period'),
            DateFormatter::unformat(request('next_date')),
            (request('stop_date')) ? DateFormatter::unformat(request('stop_date')) : '0000-00-00')->id;

        return response()->json(['success' => true, 'url' => route('recurringInvoices.edit', [$recurringInvoiceId])], 200);
    }
}
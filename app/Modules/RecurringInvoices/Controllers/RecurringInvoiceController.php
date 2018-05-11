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
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceRepository;
use FI\Support\Frequency;
use FI\Traits\ReturnUrl;

class RecurringInvoiceController extends Controller
{
    use ReturnUrl;

    private $companyProfileRepository;
    private $recurringInvoiceRepository;

    public function __construct(
        CompanyProfileRepository $companyProfileRepository,
        RecurringInvoiceRepository $recurringInvoiceRepository
    )
    {
        $this->companyProfileRepository   = $companyProfileRepository;
        $this->recurringInvoiceRepository = $recurringInvoiceRepository;
    }

    public function index()
    {
        $this->setReturnUrl();

        $status = request('status', 'all_statuses');

        $recurringInvoices = $this->recurringInvoiceRepository->with(['client', 'activities', 'amount.recurringInvoice.currency'])
            ->paginate($status, request('search'), request('client'), request('company_profile'));

        return view('recurring_invoices.index')
            ->with('recurringInvoices', $recurringInvoices)
            ->with('displaySearch', true)
            ->with('frequencies', Frequency::lists())
            ->with('status', $status)
            ->with('statuses', ['all_statuses' => trans('fi.all_statuses'), 'active' => trans('fi.active'), 'inactive' => trans('fi.inactive')])
            ->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + $this->companyProfileRepository->lists());
    }

    public function delete($id)
    {
        $this->recurringInvoiceRepository->delete($id);

        return redirect()->route('recurringInvoices.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }
}
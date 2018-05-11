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
use FI\Modules\Clients\Repositories\ClientRepository;
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceRepository;
use FI\Modules\RecurringInvoices\Validators\RecurringInvoiceValidator;
use FI\Support\Frequency;

class RecurringInvoiceCreateController extends Controller
{
    private $clientRepository;
    private $companyProfileRepository;
    private $groupRepository;
    private $recurringInvoiceRepository;
    private $recurringInvoiceValidator;

    public function __construct(
        ClientRepository $clientRepository,
        CompanyProfileRepository $companyProfileRepository,
        GroupRepository $groupRepository,
        RecurringInvoiceRepository $recurringInvoiceRepository,
        RecurringInvoiceValidator $recurringInvoiceValidator
    )
    {
        $this->clientRepository         = $clientRepository;
        $this->companyProfileRepository = $companyProfileRepository;
        $this->groupRepository          = $groupRepository;
        $this->recurringInvoiceRepository        = $recurringInvoiceRepository;
        $this->recurringInvoiceValidator         = $recurringInvoiceValidator;
    }

    public function create()
    {
        return view('recurring_invoices._modal_create')
            ->with('companyProfiles', $this->companyProfileRepository->lists())
            ->with('groups', $this->groupRepository->lists())
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

        $client = $this->clientRepository->firstOrCreate(request('client_name'));

        $recurringInvoice = $this->recurringInvoiceRepository->create(request()->all(), $client);

        return response()->json(['success' => true, 'url' => route('recurringInvoices.edit', [$recurringInvoice->id])], 200);
    }
}
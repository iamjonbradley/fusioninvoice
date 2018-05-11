<?php

namespace FI\Events\Listeners;

use FI\Events\InvoiceCreated;
use FI\Modules\CustomFields\Models\InvoiceCustom;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Invoices\Repositories\InvoiceCalculateRepository;

class InvoiceCreatedListener
{
    private $groupRepository;
    private $invoiceCalculateRepository;

    public function __construct(
        GroupRepository $groupRepository,
        InvoiceCalculateRepository $invoiceCalculateRepository
    )
    {
        $this->groupRepository            = $groupRepository;
        $this->invoiceCalculateRepository = $invoiceCalculateRepository;
    }

    public function handle(InvoiceCreated $event)
    {
        // Create the empty invoice amount record.
        $this->invoiceCalculateRepository->calculate($event->invoice->id);

        // Increment the next id.
        $this->groupRepository->incrementNextId($event->invoice->group_id);

        // Create the custom invoice record.
        $event->invoice->custom()->save(new InvoiceCustom());
    }
}

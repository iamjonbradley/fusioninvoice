<?php

namespace FI\Events\Listeners;

use FI\Events\RecurringInvoiceCreated;
use FI\Modules\CustomFields\Models\RecurringInvoiceCustom;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceCalculateRepository;

class RecurringInvoiceCreatedListener
{
    private $recurringInvoiceCalculateRepository;

    public function __construct(RecurringInvoiceCalculateRepository $recurringInvoiceCalculateRepository)
    {
        $this->recurringInvoiceCalculateRepository = $recurringInvoiceCalculateRepository;
    }

    public function handle(RecurringInvoiceCreated $event)
    {
        // Create the empty invoice amount record.
        $this->recurringInvoiceCalculateRepository->calculate($event->recurringInvoice->id);

        // Create the custom record.
        $event->recurringInvoice->custom()->save(new RecurringInvoiceCustom());
    }
}

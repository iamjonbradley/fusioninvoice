<?php

namespace FI\Events\Listeners;

use FI\Events\RecurringInvoiceModified;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceCalculateRepository;

class RecurringInvoiceModifiedListener
{
    private $recurringInvoiceCalculateRepository;

    public function __construct(RecurringInvoiceCalculateRepository $recurringInvoiceCalculateRepository)
    {
        $this->recurringInvoiceCalculateRepository = $recurringInvoiceCalculateRepository;
    }

    public function handle(RecurringInvoiceModified $event)
    {
        $this->recurringInvoiceCalculateRepository->calculate($event->recurringInvoice->id);
    }
}

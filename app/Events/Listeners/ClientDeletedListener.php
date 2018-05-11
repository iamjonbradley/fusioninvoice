<?php

namespace FI\Events\Listeners;

use FI\Events\ClientDeleted;

class ClientDeletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(ClientDeleted $event)
    {
        foreach ($event->client->quotes as $quote)
        {
            $quote->delete();
        }

        foreach ($event->client->invoices as $invoice)
        {
            $invoice->delete();
        }

        foreach ($event->client->recurringInvoices as $recurringInvoice)
        {
            $recurringInvoice->delete();
        }

        foreach ($event->client->notes as $note)
        {
            $note->delete();
        }

        $event->client->user()->delete();
        $event->client->custom()->delete();
    }
}

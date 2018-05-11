<?php

namespace FI\Events\Listeners;

use FI\Events\ClientCreating;

class ClientCreatingListener
{
    public function __construct()
    {
        //
    }

    public function handle(ClientCreating $event)
    {
        $event->client->url_key = str_random(32);

        if (!$event->client->currency_code)
        {
            $event->client->currency_code = config('fi.baseCurrency');
        }

        if (!$event->client->invoice_template)
        {
            $event->client->invoice_template = config('fi.invoiceTemplate');
        }

        if (!$event->client->quote_template)
        {
            $event->client->quote_template = config('fi.quoteTemplate');
        }

        if (!$event->client->language)
        {
            $event->client->language = config('fi.language');
        }
    }
}

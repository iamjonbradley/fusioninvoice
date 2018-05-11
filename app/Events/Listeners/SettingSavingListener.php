<?php

namespace FI\Events\Listeners;

use FI\Events\SettingSaving;
use FI\Modules\Clients\Models\Client;
use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\Quotes\Models\Quote;

class SettingSavingListener
{
    public function __construct()
    {
        //
    }

    public function handle(SettingSaving $event)
    {
        if ($event->setting->setting_key == 'invoiceTemplate' or $event->setting->setting_key == 'quoteTemplate')
        {
            $original = $event->setting->getOriginal();

            if (isset($original['setting_value']) and $original['setting_value'] !== $event->setting->setting_value)
            {
                $templateType     = $event->setting->setting_key;
                $originalTemplate = $original['setting_value'];
                $newTemplate      = $event->setting->setting_value;

                if ($templateType == 'invoiceTemplate')
                {
                    Client::whereNull('invoice_template')->orWhere('invoice_template', $originalTemplate)->orWhere('invoice_template', '')->update(['invoice_template' => $newTemplate]);
                    Invoice::whereNull('template')->orWhere('template', $originalTemplate)->orWhere('template', '')->update(['template' => $newTemplate]);
                }
                elseif ($templateType == 'quoteTemplate')
                {
                    Client::whereNull('quote_template')->orWhere('quote_template', $originalTemplate)->orWhere('quote_template', '')->update(['quote_template' => $newTemplate]);
                    Quote::whereNull('template')->orWhere('template', $originalTemplate)->orWhere('template', '')->update(['template' => $newTemplate]);
                }
            }
        }
    }
}

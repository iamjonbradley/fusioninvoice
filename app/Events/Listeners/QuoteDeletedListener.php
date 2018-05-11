<?php

namespace FI\Events\Listeners;

use FI\Events\QuoteDeleted;

class QuoteDeletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(QuoteDeleted $event)
    {
        foreach ($event->quote->items as $item)
        {
            $item->delete();
        }

        foreach ($event->quote->activities as $activity)
        {
            $activity->delete();
        }

        foreach ($event->quote->mailQueue as $mailQueue)
        {
            $mailQueue->delete();
        }

        foreach ($event->quote->notes as $note)
        {
            $note->delete();
        }

        $event->quote->custom()->delete();
        $event->quote->amount()->delete();
    }
}

<?php

namespace FI\Events\Listeners;

use FI\Events\QuoteModified;
use FI\Modules\Quotes\Repositories\QuoteCalculateRepository;

class QuoteModifiedListener
{
    public function __construct(QuoteCalculateRepository $quoteCalculateRepository)
    {
        $this->quoteCalculateRepository = $quoteCalculateRepository;
    }

    public function handle(QuoteModified $event)
    {
        // Calculate the quote and item amounts
        $this->quoteCalculateRepository->calculate($event->quote->id);
    }
}

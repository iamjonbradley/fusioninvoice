<?php

namespace FI\Events\Listeners;

use FI\Events\QuoteCreated;
use FI\Modules\CustomFields\Models\QuoteCustom;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Quotes\Repositories\QuoteCalculateRepository;

class QuoteCreatedListener
{
    public function __construct(GroupRepository $groupRepository, QuoteCalculateRepository $quoteCalculateRepository)
    {
        $this->groupRepository          = $groupRepository;
        $this->quoteCalculateRepository = $quoteCalculateRepository;
    }

    public function handle(QuoteCreated $event)
    {
        // Create the empty quote amount record
        $this->quoteCalculateRepository->calculate($event->quote->id);

        // Increment the next id
        $this->groupRepository->incrementNextId($event->quote->group_id);

        // Create the custom quote record.
        $event->quote->custom()->save(new QuoteCustom());
    }
}

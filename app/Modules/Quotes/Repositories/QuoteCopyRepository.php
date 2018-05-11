<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Repositories;

use FI\Events\QuoteCreated;
use FI\Modules\Clients\Repositories\ClientRepository;
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\CustomFields\Repositories\QuoteCustomRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Quotes\Models\Quote;
use FI\Modules\Quotes\Models\QuoteItem;
use FI\Support\Statuses\QuoteStatuses;

class QuoteCopyRepository
{
    private $clientRepository;
    private $companyProfileRepository;
    private $groupRepository;
    private $quoteCustomRepository;

    public function __construct(
        ClientRepository $clientRepository,
        CompanyProfileRepository $companyProfileRepository,
        GroupRepository $groupRepository,
        QuoteCustomRepository $quoteCustomRepository
    )
    {
        $this->clientRepository         = $clientRepository;
        $this->companyProfileRepository = $companyProfileRepository;
        $this->groupRepository          = $groupRepository;
        $this->quoteCustomRepository    = $quoteCustomRepository;
    }

    public function copyQuote($fromQuoteId, $clientListIdentifier, $createdAt, $expiresAt, $groupId, $userId, $companyProfileId)
    {
        $fromQuote = Quote::find($fromQuoteId);
        $client    = $this->clientRepository->firstOrCreate($clientListIdentifier);

        $toQuote = Quote::create([
            'client_id'          => $client->id,
            'company_profile_id' => $companyProfileId,
            'created_at'         => $createdAt,
            'expires_at'         => $expiresAt,
            'group_id'           => $groupId,
            'number'             => $this->groupRepository->generateNumber($groupId),
            'user_id'            => $userId,
            'quote_status_id'    => QuoteStatuses::getStatusId('draft'),
            'currency_code'      => $fromQuote->currency_code,
            'exchange_rate'      => $fromQuote->exchange_rate,
            'terms'              => $fromQuote->terms,
            'footer'             => $fromQuote->footer,
            'template'           => $fromQuote->template,
            'summary'            => $fromQuote->summary,
            'discount'           => $fromQuote->discount,
        ]);

        foreach ($fromQuote->items as $item)
        {
            QuoteItem::create(
                [
                    'quote_id'      => $toQuote->id,
                    'name'          => $item->name,
                    'description'   => $item->description,
                    'quantity'      => $item->quantity,
                    'price'         => $item->price,
                    'tax_rate_id'   => $item->tax_rate_id,
                    'tax_rate_2_id' => $item->tax_rate_2_id,
                    'display_order' => $item->display_order,
                ]
            );
        }

        event(new QuoteCreated($toQuote));

        // Copy the custom fields
        $custom = collect($fromQuote->custom)->except('quote_id')->toArray();
        $this->quoteCustomRepository->save($custom, $toQuote->id);

        return $toQuote;
    }
}
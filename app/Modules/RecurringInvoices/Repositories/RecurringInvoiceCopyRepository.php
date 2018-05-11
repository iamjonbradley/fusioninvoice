<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\RecurringInvoices\Repositories;

use FI\Events\RecurringInvoiceCreated;
use FI\Modules\Clients\Repositories\ClientRepository;
use FI\Modules\CustomFields\Repositories\RecurringInvoiceCustomRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Modules\RecurringInvoices\Models\RecurringInvoiceItem;

class RecurringInvoiceCopyRepository
{
    private $clientRepository;
    private $groupRepository;
    private $recurringInvoiceCustomRepository;

    public function __construct(
        ClientRepository $clientRepository,
        GroupRepository $groupRepository,
        RecurringInvoiceCustomRepository $recurringInvoiceCustomRepository
    )
    {
        $this->clientRepository                 = $clientRepository;
        $this->groupRepository                  = $groupRepository;
        $this->recurringInvoiceCustomRepository = $recurringInvoiceCustomRepository;
    }

    public function copyRecurringInvoice($fromRecurringInvoiceId, $clientListIdentifier, $groupId, $userId, $companyProfileId, $recurringFrequency, $recurringPeriod, $nextDate, $stopDate)
    {
        $client = $this->clientRepository->firstOrCreate($clientListIdentifier);

        $fromRecurringInvoice = RecurringInvoice::find($fromRecurringInvoiceId);

        $toRecurringInvoice = RecurringInvoice::create([
            'client_id'           => $client->id,
            'company_profile_id'  => $companyProfileId,
            'group_id'            => $groupId,
            'user_id'             => $userId,
            'currency_code'       => $fromRecurringInvoice->currency_code,
            'exchange_rate'       => $fromRecurringInvoice->exchange_rate,
            'terms'               => $fromRecurringInvoice->terms,
            'footer'              => $fromRecurringInvoice->footer,
            'template'            => $fromRecurringInvoice->template,
            'summary'             => $fromRecurringInvoice->summary,
            'discount'            => $fromRecurringInvoice->discount,
            'recurring_frequency' => $recurringFrequency,
            'recurring_period'    => $recurringPeriod,
            'next_date'           => $nextDate,
            'stop_date'           => $stopDate,
        ]);

        foreach ($fromRecurringInvoice->items as $item)
        {
            RecurringInvoiceItem::create([
                'recurring_invoice_id' => $toRecurringInvoice->id,
                'name'                 => $item->name,
                'description'          => $item->description,
                'quantity'             => $item->quantity,
                'price'                => $item->price,
                'tax_rate_id'          => $item->tax_rate_id,
                'tax_rate_2_id'        => $item->tax_rate_2_id,
                'display_order'        => $item->display_order,
            ]);
        }

        event(new RecurringInvoiceCreated($toRecurringInvoice));

        // Copy the custom fields
        $custom = collect($fromRecurringInvoice->custom)->except('recurring_invoice_id')->toArray();
        $this->recurringInvoiceCustomRepository->save($custom, $toRecurringInvoice->id);

        return $toRecurringInvoice;
    }
}
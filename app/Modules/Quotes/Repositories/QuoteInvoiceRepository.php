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

use FI\Events\InvoiceModified;
use FI\Modules\CustomFields\Repositories\CustomFieldRepository;
use FI\Modules\CustomFields\Repositories\InvoiceCustomRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Invoices\Repositories\InvoiceItemRepository;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Support\Statuses\InvoiceStatuses;

class QuoteInvoiceRepository
{
    private $customFieldRepository;
    private $invoiceRepository;
    private $invoiceItemRepository;
    private $quoteItemRepository;

    public function __construct(
        CustomFieldRepository $customFieldRepository,
        GroupRepository $groupRepository,
        InvoiceRepository $invoiceRepository,
        InvoiceItemRepository $invoiceItemRepository,
        QuoteItemRepository $quoteItemRepository
    )
    {
        $this->customFieldRepository = $customFieldRepository;
        $this->groupRepository       = $groupRepository;
        $this->invoiceRepository     = $invoiceRepository;
        $this->invoiceItemRepository = $invoiceItemRepository;
        $this->quoteItemRepository   = $quoteItemRepository;
    }

    public function quoteToInvoice($quote, $createdAt, $dueAt, $groupId)
    {
        $record = [
            'client_id'          => $quote->client_id,
            'created_at'         => $createdAt,
            'due_at'             => $dueAt,
            'group_id'           => $groupId,
            'number'             => $this->groupRepository->generateNumber($groupId),
            'user_id'            => $quote->user_id,
            'invoice_status_id'  => InvoiceStatuses::getStatusId('draft'),
            'terms'              => ((config('fi.convertQuoteTerms') == 'quote') ? $quote->terms : config('fi.invoiceTerms')),
            'footer'             => $quote->footer,
            'currency_code'      => $quote->currency_code,
            'exchange_rate'      => $quote->exchange_rate,
            'summary'            => $quote->summary,
            'discount'           => $quote->discount,
            'company_profile_id' => $quote->company_profile_id,
        ];

        $toInvoice = $this->invoiceRepository->create($record, $quote->client, false);

        $this->customFieldRepository->copyCustomFieldValues($quote->custom, 'quotes', 'invoices', new InvoiceCustomRepository(), $toInvoice->id);

        $quote->invoice_id = $toInvoice->id;
        $quote->save();

        $items = $this->quoteItemRepository->findByQuoteId($quote->id);

        foreach ($items as $item)
        {
            $itemRecord = [
                'invoice_id'    => $toInvoice->id,
                'name'          => $item->name,
                'description'   => $item->description,
                'quantity'      => $item->quantity,
                'price'         => $item->price,
                'tax_rate_id'   => $item->tax_rate_id,
                'tax_rate_2_id' => $item->tax_rate_2_id,
                'display_order' => $item->display_order,
            ];

            $this->invoiceItemRepository->create($itemRecord);
        }

        event(new InvoiceModified($toInvoice));

        return $toInvoice;
    }
}
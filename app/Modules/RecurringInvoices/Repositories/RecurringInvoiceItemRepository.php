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

use FI\Events\RecurringInvoiceModified;
use FI\Modules\RecurringInvoices\Models\RecurringInvoiceItem;
use FI\Modules\ItemLookups\Repositories\ItemLookupRepository;
use FI\Support\NumberFormatter;

class RecurringInvoiceItemRepository
{
    public function __construct(ItemLookupRepository $itemLookupRepository)
    {
        $this->itemLookupRepository = $itemLookupRepository;
    }

    public function find($id)
    {
        return RecurringInvoiceItem::find($id);
    }

    public function findByRecurringInvoiceId($recurringInvoiceId)
    {
        return RecurringInvoiceItem::orderBy('display_order')->where('recurring_invoice_id', '=', $recurringInvoiceId)->get();
    }

    public function create($input)
    {
        return RecurringInvoiceItem::create($input);
    }

    public function update($input, $id)
    {
        $recurringInvoiceItem = RecurringInvoiceItem::find($id);

        $recurringInvoiceItem->fill($input);

        $recurringInvoiceItem->save();

        return $recurringInvoiceItem;
    }

    public function saveItems($items, $applyExchangeRate = false, $exchangeRate = 1, $unformat = true)
    {
        foreach ($items as $item)
        {
            $this->saveItem($item, $applyExchangeRate, $exchangeRate, $unformat);
        }
    }

    public function saveItem($item, $applyExchangeRate = false, $exchangeRate = 1, $unformat = true)
    {
        if ($item['item_name'])
        {
            $itemDescription = (isset($item['item_description'])) ? $item['item_description'] : '';
            $itemTaxRateId   = (isset($item['item_tax_rate_id'])) ? $item['item_tax_rate_id'] : 0;
            $itemTaxRate2Id  = (isset($item['item_tax_rate_2_id'])) ? $item['item_tax_rate_2_id'] : 0;
            $itemOrder       = (isset($item['item_order'])) ? $item['item_order'] : $this->findNextDisplayOrder($item['recurring_invoice_id']);

            if ($unformat == true)
            {
                $quantity = NumberFormatter::unformat($item['item_quantity']);

                if ($applyExchangeRate == true)
                {
                    $price = NumberFormatter::unformat($item['item_price']) * $exchangeRate;
                }
                else
                {
                    $price = NumberFormatter::unformat($item['item_price']);
                }
            }
            else
            {
                $quantity = $item['item_quantity'];

                if ($applyExchangeRate == true)
                {
                    $price = $item['item_price'] * $exchangeRate;
                }
                else
                {
                    $price = $item['item_price'];
                }
            }

            $itemRecord = [
                'recurring_invoice_id'    => $item['recurring_invoice_id'],
                'name'          => $item['item_name'],
                'description'   => $itemDescription,
                'quantity'      => $quantity,
                'price'         => $price,
                'tax_rate_id'   => $itemTaxRateId,
                'tax_rate_2_id' => $itemTaxRate2Id,
                'display_order' => $itemOrder,
            ];

            if (!isset($item['item_id']) or (!$item['item_id']))
            {
                RecurringInvoiceItem::create($itemRecord);
            }
            else
            {
                $recurringInvoiceItem = RecurringInvoiceItem::find($item['item_id']);

                $recurringInvoiceItem->fill($itemRecord);

                $recurringInvoiceItem->save();
            }

            if (isset($item['save_item_as_lookup']) and $item['save_item_as_lookup'])
            {
                $itemLookupRecord = [
                    'name'          => $item['item_name'],
                    'description'   => $item['item_description'],
                    'price'         => NumberFormatter::unformat($item['item_price']),
                    'tax_rate_id'   => $itemTaxRateId,
                    'tax_rate_2_id' => $itemTaxRate2Id,
                ];

                $this->itemLookupRepository->create($itemLookupRecord);
            }
        }
    }

    protected function findNextDisplayOrder($recurringInvoiceId)
    {
        $displayOrder = RecurringInvoiceItem::where('recurring_invoice_id', $recurringInvoiceId)->max('display_order');

        $displayOrder++;

        return $displayOrder;
    }

    public function delete($id)
    {
        $recurringInvoiceItem = RecurringInvoiceItem::find($id);

        $recurringInvoice = $recurringInvoiceItem->recurringInvoice;

        $recurringInvoiceItem->delete();

        event(new RecurringInvoiceModified($recurringInvoice));
    }
}
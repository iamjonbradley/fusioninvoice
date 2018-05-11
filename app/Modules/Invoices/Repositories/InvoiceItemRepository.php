<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Repositories;

use FI\Events\InvoiceModified;
use FI\Modules\Invoices\Models\InvoiceItem;
use FI\Modules\ItemLookups\Repositories\ItemLookupRepository;
use FI\Support\NumberFormatter;

class InvoiceItemRepository
{
    public function __construct(ItemLookupRepository $itemLookupRepository)
    {
        $this->itemLookupRepository = $itemLookupRepository;
    }

    public function find($id)
    {
        return InvoiceItem::find($id);
    }

    public function findByInvoiceId($invoiceId)
    {
        return InvoiceItem::orderBy('display_order')->where('invoice_id', '=', $invoiceId)->get();
    }

    public function create($input)
    {
        return InvoiceItem::create($input);
    }

    public function update($input, $id)
    {
        $invoiceItem = InvoiceItem::find($id);

        $invoiceItem->fill($input);

        $invoiceItem->save();

        return $invoiceItem;
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
            $itemOrder       = (isset($item['item_order'])) ? $item['item_order'] : $this->findNextDisplayOrder($item['invoice_id']);

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
                'invoice_id'    => $item['invoice_id'],
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
                InvoiceItem::create($itemRecord);
            }
            else
            {
                $invoiceItem = InvoiceItem::find($item['item_id']);

                $invoiceItem->fill($itemRecord);

                $invoiceItem->save();
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

    protected function findNextDisplayOrder($invoiceId)
    {
        $displayOrder = InvoiceItem::where('invoice_id', $invoiceId)->max('display_order');

        $displayOrder++;

        return $displayOrder;
    }

    public function delete($id)
    {
        $invoiceItem = InvoiceItem::find($id);

        $invoice = $invoiceItem->invoice;

        $invoiceItem->delete();

        event(new InvoiceModified($invoice));
    }
}
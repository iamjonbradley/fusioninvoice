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

use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Modules\RecurringInvoices\Models\RecurringInvoiceAmount;
use FI\Modules\RecurringInvoices\Models\RecurringInvoiceItem;
use FI\Modules\RecurringInvoices\Models\RecurringInvoiceItemAmount;
use FI\Support\Calculators\RecurringInvoiceCalculator;

class RecurringInvoiceCalculateRepository
{
    public function calculate($recurringInvoiceId)
    {
        $recurringInvoice = RecurringInvoice::find($recurringInvoiceId);

        $recurringInvoiceItems = RecurringInvoiceItem::select('recurring_invoice_items.*',
            'tax_rates_1.percent AS tax_rate_1_percent',
            'tax_rates_2.percent AS tax_rate_2_percent',
            'tax_rates_2.is_compound AS tax_rate_2_is_compound')
            ->leftJoin('tax_rates AS tax_rates_1', 'recurring_invoice_items.tax_rate_id', '=', 'tax_rates_1.id')
            ->leftJoin('tax_rates AS tax_rates_2', 'recurring_invoice_items.tax_rate_2_id', '=', 'tax_rates_2.id')
            ->where('recurring_invoice_id', $recurringInvoiceId)
            ->get();

        $calculator = new RecurringInvoiceCalculator;
        $calculator->setId($recurringInvoiceId);
        $calculator->setDiscount($recurringInvoice->discount);

        foreach ($recurringInvoiceItems as $recurringInvoiceItem)
        {
            $taxRatePercent     = ($recurringInvoiceItem->tax_rate_id) ? $recurringInvoiceItem->tax_rate_1_percent : 0;
            $taxRate2Percent    = ($recurringInvoiceItem->tax_rate_2_id) ? $recurringInvoiceItem->tax_rate_2_percent : 0;
            $taxRate2IsCompound = ($recurringInvoiceItem->tax_rate_2_is_compound) ? 1 : 0;

            $calculator->addItem($recurringInvoiceItem->id, $recurringInvoiceItem->quantity, $recurringInvoiceItem->price, $taxRatePercent, $taxRate2Percent, $taxRate2IsCompound);
        }

        $calculator->calculate();

        // Get the calculated values
        $calculatedItemAmounts = $calculator->getCalculatedItemAmounts();
        $calculatedAmount      = $calculator->getCalculatedAmount();

        // Update the item amount records
        foreach ($calculatedItemAmounts as $calculatedItemAmount)
        {
            $recurringInvoiceItemAmount = RecurringInvoiceItemAmount::firstOrNew(['item_id' => $calculatedItemAmount['item_id']]);
            $recurringInvoiceItemAmount->fill($calculatedItemAmount);
            $recurringInvoiceItemAmount->save();
        }

        // Update the overall recurringInvoice amount record
        $recurringInvoiceAmount = RecurringInvoiceAmount::firstOrNew(['recurring_invoice_id' => $recurringInvoiceId]);
        $recurringInvoiceAmount->fill($calculatedAmount);
        $recurringInvoiceAmount->save();
    }

    public function calculateAll()
    {
        $recurringInvoiceIds = RecurringInvoice::select('id')->get();

        foreach ($recurringInvoiceIds as $recurringInvoiceId)
        {
            $this->calculate($recurringInvoiceId->id);
        }
    }
}
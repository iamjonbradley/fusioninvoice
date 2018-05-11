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

use FI\Modules\RecurringInvoices\Models\RecurringInvoiceAmount;

class RecurringInvoiceAmountRepository
{
    public function findByRecurringInvoiceId($recurringInvoiceId)
    {
        return RecurringInvoiceAmount::where('recurring_invoice_id', '=', $recurringInvoiceId)->first();
    }

    public function create($recurringInvoiceId)
    {
        return RecurringInvoiceAmount::create([
            'recurring_invoice_id' => $recurringInvoiceId,
            'subtotal'   => 0,
            'tax'        => 0,
            'total'      => 0,
        ]);
    }

    public function update($input, $recurringInvoiceId)
    {
        $recurringInvoiceAmount = RecurringInvoiceAmount::where('recurring_invoice_id', $recurringInvoiceId)->first();

        if ($recurringInvoiceAmount)
        {
            $recurringInvoiceAmount->fill($input);

            $recurringInvoiceAmount->save();
        }

        return $recurringInvoiceAmount;
    }
}
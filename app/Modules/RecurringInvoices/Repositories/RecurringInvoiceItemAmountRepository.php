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

use FI\Modules\RecurringInvoices\Models\RecurringInvoiceItemAmount;

class RecurringInvoiceItemAmountRepository
{
    public function update($input, $itemId)
    {
        $recurringInvoiceItemAmount = RecurringInvoiceItemAmount::where('item_id', $itemId)->first();

        $recurringInvoiceItemAmount->fill($input);

        $recurringInvoiceItemAmount->save();

        return $recurringInvoiceItemAmount;
    }

    public function deleteByItemId($itemId)
    {
        RecurringInvoiceItemAmount::where('item_id', $itemId)->delete();
    }
}
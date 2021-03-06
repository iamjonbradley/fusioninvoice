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

use FI\Modules\Quotes\Models\QuoteItemAmount;

class QuoteItemAmountRepository
{
    public function update($input, $itemId)
    {
        $quoteItemAmount = QuoteItemAmount::where('item_id', $itemId)->first();

        $quoteItemAmount->fill($input);

        $quoteItemAmount->save();

        return $quoteItemAmount;
    }

    public function deleteByItemId($itemId)
    {
        QuoteItemAmount::where('item_id', $itemId)->delete();
    }
}
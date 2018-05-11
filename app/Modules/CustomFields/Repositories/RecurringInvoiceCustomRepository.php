<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Repositories;

use FI\Modules\CustomFields\Models\RecurringInvoiceCustom;

class RecurringInvoiceCustomRepository
{
    public function save($input, $recurringInvoiceId)
    {
        $record = (RecurringInvoiceCustom::find($recurringInvoiceId)) ?: new RecurringInvoiceCustom;

        $record->recurring_invoice_id = $recurringInvoiceId;

        $record->fill($input);

        $record->save();

        return $record;
    }

    public function delete($id)
    {
        RecurringInvoiceCustom::destroy($id);
    }
}
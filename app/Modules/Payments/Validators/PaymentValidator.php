<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Payments\Validators;

use FI\Support\NumberFormatter;
use Illuminate\Support\Facades\Validator;

class PaymentValidator
{
    private function getAttributeNames()
    {
        return [
            'paid_at'           => trans('fi.payment_date'),
            'invoice_id'        => trans('fi.invoice'),
            'amount'            => trans('fi.amount'),
            'payment_method_id' => trans('fi.payment_method'),
        ];
    }

    public function getValidator($input)
    {
        $input['amount'] = (isset($input['amount'])) ? NumberFormatter::unformat($input['amount']) : null;

        return Validator::make($input, [
                'paid_at'           => 'required',
                'invoice_id'        => 'required',
                'amount'            => 'required|numeric',
                'payment_method_id' => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
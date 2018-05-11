<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\PaymentMethods\Validators;

use Illuminate\Support\Facades\Validator;

class PaymentMethodValidator
{
    private function getAttributeNames()
    {
        return [
            'name' => trans('fi.payment_method')
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'name' => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
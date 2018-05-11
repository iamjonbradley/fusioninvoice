<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TaxRates\Validators;

use Illuminate\Support\Facades\Validator;

class TaxRateValidator
{
    private function getAttributeNames()
    {
        return [
            'name'    => trans('fi.name'),
            'percent' => trans('fi.percent'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'name'    => 'required',
                'percent' => 'required|numeric',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
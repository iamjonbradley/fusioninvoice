<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\ItemLookups\Validators;

use Illuminate\Support\Facades\Validator;

class ItemLookupValidator
{
    private function getAttributeNames()
    {
        return [
            'name'  => trans('fi.name'),
            'price' => trans('fi.price'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'name'  => 'required',
                'price' => 'required|numeric',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
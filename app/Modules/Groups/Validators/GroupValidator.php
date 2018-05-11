<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Groups\Validators;

use Illuminate\Support\Facades\Validator;

class GroupValidator
{
    private function getAttributeNames()
    {
        return [
            'name'     => trans('fi.name'),
            'next_id'  => trans('fi.next_number'),
            'left_pad' => trans('fi.left_pad'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'name'     => 'required',
            'next_id'  => 'required|integer',
            'left_pad' => 'required|numeric',
        ])->setAttributeNames($this->getAttributeNames());
    }
}
<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Validators;

use Illuminate\Support\Facades\Validator;

class CustomFieldValidator
{
    private function getAttributeNames()
    {
        return [
            'tbl_name'    => trans('fi.table_name'),
            'field_label' => trans('fi.field_label'),
            'field_type'  => trans('fi.field_type'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'tbl_name'    => 'required',
            'field_label' => 'required',
            'field_type'  => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdateValidator($input)
    {
        return Validator::make($input, [
            'field_label' => 'required',
            'field_type'  => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }
}
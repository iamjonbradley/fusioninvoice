<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Validators;

use Illuminate\Support\Facades\Validator;

class ReportValidator
{
    private function getAttributeNames()
    {
        return [
            'from_date' => trans('fi.from_date'),
            'to_date'   => trans('fi.to_date'),
            'year'      => trans('fi.year'),
        ];
    }

    public function getDateRangeValidator($input)
    {
        return Validator::make($input, [
                'from_date' => 'required',
                'to_date'   => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }

    public function getYearValidator($input)
    {
        return Validator::make($input, [
                'year' => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
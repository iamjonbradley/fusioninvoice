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

class ClientStatementReportValidator
{
    private function getAttributeNames()
    {
        return [
            'from_date'   => trans('fi.from_date'),
            'to_date'     => trans('fi.to_date'),
            'client_name' => trans('fi.client'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'from_date'   => 'required',
                'to_date'     => 'required',
                'client_name' => 'required|exists:clients,unique_name',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Validators;

use Illuminate\Support\Facades\Validator;

class QuoteValidator
{
    private function getAttributeNames()
    {
        return [
            'company_profile_id' => trans('fi.company_profile'),
            'client_name'        => trans('fi.client'),
            'user_id'            => trans('fi.user'),
            'summary'            => trans('fi.summary'),
            'created_at'         => trans('fi.date'),
            'expires_at'         => trans('fi.expires'),
            'number'             => trans('fi.quote_number'),
            'quote_status_id'    => trans('fi.status'),
            'exchange_rate'      => trans('fi.exchange_rate'),
            'client_id'          => trans('fi.client'),
            'group_id'           => trans('fi.group'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'created_at'         => 'required',
                'company_profile_id' => 'required|integer|exists:company_profiles,id',
                'client_name'        => 'required',
                'user_id'            => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdateValidator($input)
    {
        return Validator::make($input, [
                'summary'         => 'max:100',
                'created_at'      => 'required',
                'expires_at'      => 'required',
                'number'          => 'required',
                'quote_status_id' => 'required',
                'exchange_rate'   => 'required|numeric',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }

    public function getToInvoiceValidator($input)
    {
        return Validator::make($input, [
                'client_id'  => 'required',
                'created_at' => 'required',
                'group_id'   => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }

    public function getRawValidator($input)
    {
        return Validator::make($input, [
                'summary'            => 'max:100',
                'created_at'         => 'required|date',
                'company_profile_id' => 'required|integer|exists:company_profiles,id',
                'user_id'            => 'required|integer',
                'client_id'          => 'required|integer',
                'group_id'           => 'required|integer',
                'quote_status_id'    => 'required|integer',
                'expires_at'         => 'required|date',
                'number'             => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
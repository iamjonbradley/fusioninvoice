<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Validators;

use Illuminate\Support\Facades\Validator;

class InvoiceValidator
{
    private function getAttributeNames()
    {
        return [
            'company_profile_id' => trans('fi.company_profile'),
            'client_name'        => trans('fi.client'),
            'client_id'          => trans('fi.client'),
            'user_id'            => trans('fi.user'),
            'summary'            => trans('fi.summary'),
            'created_at'         => trans('fi.date'),
            'due_at'             => trans('fi.due'),
            'number'             => trans('fi.invoice_number'),
            'invoice_status_id'  => trans('fi.status'),
            'exchange_rate'      => trans('fi.exchange_rate'),
            'template'           => trans('fi.template'),
            'group_id'           => trans('fi.group'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'company_profile_id' => 'required|integer|exists:company_profiles,id',
            'client_name'        => 'required',
            'created_at'         => 'required',
            'user_id'            => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdateValidator($input)
    {
        return Validator::make($input, [
            'summary'           => 'max:100',
            'created_at'        => 'required',
            'due_at'            => 'required',
            'number'            => 'required',
            'invoice_status_id' => 'required',
            'exchange_rate'     => 'required|numeric',
            'template'          => 'required',
        ])->setAttributeNames($this->getAttributeNames());
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
            'invoice_status_id'  => 'required|integer',
            'due_at'             => 'required|date',
            'number'             => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }
}
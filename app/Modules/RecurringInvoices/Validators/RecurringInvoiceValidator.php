<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\RecurringInvoices\Validators;

use Illuminate\Support\Facades\Validator;

class RecurringInvoiceValidator
{
    private function getAttributeNames()
    {
        return [
            'company_profile_id'  => trans('fi.company_profile'),
            'client_name'         => trans('fi.client'),
            'user_id'             => trans('fi.user'),
            'next_date'           => trans('fi.start_date'),
            'recurring_frequency' => trans('fi.frequency'),
            'recurring_period'    => trans('fi.frequency'),
            'summary'             => trans('fi.summary'),
            'exchange_rate'       => trans('fi.exchange_rate'),
            'template'            => trans('fi.template'),
            'client_id'           => trans('fi.client'),
            'group_id'            => trans('fi.group'),
            'stop_date'           => trans('fi.stop_date'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'company_profile_id'  => 'required',
            'client_name'         => 'required',
            'user_id'             => 'required',
            'next_date'           => 'required',
            'recurring_frequency' => 'numeric|required',
            'recurring_period'    => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdateValidator($input)
    {
        return Validator::make($input, [
            'summary'             => 'max:100',
            'exchange_rate'       => 'required|numeric',
            'template'            => 'required',
            'next_date'           => 'required_without:stop_date',
            'recurring_frequency' => 'numeric|required',
            'recurring_period'    => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

    public function getRawValidator($input)
    {
        return Validator::make($input, [
            'summary'            => 'max:100',
            'company_profile_id' => 'required|integer',
            'user_id'            => 'required|integer',
            'client_id'          => 'required|integer',
            'group_id'           => 'required|integer',
        ])->setAttributeNames($this->getAttributeNames());
    }
}
<?php

/**
 * This file is an addon to FusionInvoice by Amber Orchard.
 *
 * (c) Amber Orchard, LLC <jonathan@amberorchard.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Credentials\Validators;

use Illuminate\Support\Facades\Validator;

class CredentialValidator
{
    private function getAttributeNames()
    {
        return [
            'client_name'     => trans('fi.client'),
            'user_id'       => trans('fi.user'),
            'credential_type'          => trans('fi.credential_type'),
            'details'       => trans('fi.details'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
            'client_name'       => 'required',
            'user_id'           => 'required',
            'credential_type'   => 'required',
            'name'              => 'required',
            'details'           => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

    public function getValidatorAjax($input)
    {
        return Validator::make($input, [
            'client_id'        => 'required',
            'user_id'           => 'required',
            'credential_type'   => 'required',
            'name'              => 'required',
            'details'           => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdateValidator($input)
    {
        return Validator::make($input, [
            'client_id'         => 'required',
            'user_id'           => 'required',
            'credential_type'   => 'required',
            'name'              => 'required',
            'details'           => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }

    public function getRawValidator($input)
    {
        return Validator::make($input, [
            'client_name'       => 'required',
            'user_id'           => 'required',
            'credential_type'   => 'required',
            'name'              => 'required',
            'details'           => 'required',
        ])->setAttributeNames($this->getAttributeNames());
    }
}
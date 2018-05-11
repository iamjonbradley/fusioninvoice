<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Users\Validators;

use Illuminate\Support\Facades\Validator;

class UserValidator
{
    private function getAttributeNames()
    {
        return [
            'email'    => trans('fi.email'),
            'password' => trans('fi.password'),
            'name'     => trans('fi.name'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'email'    => 'required|email',
                'password' => 'required|confirmed',
                'name'     => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdateValidator($input)
    {
        return Validator::make($input, [
                'email' => 'required|email',
                'name'  => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdatePasswordValidator($input)
    {
        return Validator::make($input, [
                'password' => 'required|confirmed',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
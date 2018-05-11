<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Sessions\Validators;

use Illuminate\Support\Facades\Validator;

class SessionValidator
{
    private function getAttributeNames()
    {
        return [
            'email'    => trans('fi.email'),
            'password' => trans('fi.password'),
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'email'    => 'required|email',
                'password' => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
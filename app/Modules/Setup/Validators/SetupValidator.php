<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Setup\Validators;

use Illuminate\Support\Facades\Validator;

class SetupValidator
{
    private function getAttributeNames()
    {
        return [
            'user.name'               => trans('fi.name'),
            'user.email'              => trans('fi.email'),
            'user.password'           => trans('fi.password'),
            'company_profile.company' => trans('fi.company_profile'),
        ];
    }

    public function getLicenseValidator($input)
    {
        return Validator::make($input, [
                'accept' => 'accepted',
            ]
        );
    }

    public function getUserValidator($input)
    {
        return Validator::make($input, [
                'user.name'               => 'required',
                'user.email'              => 'required|email',
                'user.password'           => 'required|confirmed',
                'company_profile.company' => 'required',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
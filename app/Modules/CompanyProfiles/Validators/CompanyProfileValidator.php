<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CompanyProfiles\Validators;

use Illuminate\Support\Facades\Validator;

class CompanyProfileValidator
{
    private function getAttributeNames()
    {
        return [
            'company' => trans('fi.company')
        ];
    }
    public function getValidator($input)
    {
        return Validator::make($input, [
                'company' => 'required|unique:company_profiles,company',
            ]
        )->setAttributeNames($this->getAttributeNames());
    }

    public function getUpdateValidator($input, $id)
    {
        return Validator::make($input, [
                'company' => 'required|unique:company_profiles,company,' . $id,
            ]
        )->setAttributeNames($this->getAttributeNames());
    }
}
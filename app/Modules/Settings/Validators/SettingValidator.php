<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Settings\Validators;

use Illuminate\Support\Facades\Validator;

class SettingValidator
{
    private function getAttributeNames()
    {
        return [
            'invoicesDueAfter'  => trans('fi.invoices_due_after'),
            'quotesExpireAfter' => trans('fi.quotes_expire_after'),
            'pdfBinaryPath'     => trans('fi.binary_path'),
        ];
    }

    public function getValidator($input)
    {
        Validator::extend('valid_file', function ($attribute, $value, $parameters, $validator)
        {
            $settings = request('setting');

            if ($settings['pdfDriver'] == 'wkhtmltopdf')
            {
                return is_file($value);
            }

            return true;
        });

        $rules = [
            'invoicesDueAfter'  => 'required|numeric',
            'quotesExpireAfter' => 'required|numeric',
            'pdfBinaryPath'     => 'required_if:pdfDriver,wkhtmltopdf|valid_file',
        ];

        $messages = [
            'valid_file' => trans('fi.pdf_driver_wkhtmltopdf'),
        ];

        foreach (config('fi.settingValidationRules') as $settingValidationRules)
        {
            $rules = array_merge($rules, $settingValidationRules['rules']);

            if (isset($settingValidationRules['messages']))
            {
                $messages = array_merge($messages, $settingValidationRules['messages']);
            }
        }

        return Validator::make($input, $rules, $messages)->setAttributeNames($this->getAttributeNames());
    }
}
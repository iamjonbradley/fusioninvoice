<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Merchant\Support\Drivers;

use Illuminate\Support\Facades\Validator;
use Omnipay\Omnipay;

class Stripe
{
    public static function createGateway()
    {
        $gateway = Omnipay::create('Stripe');

        $merchant = config('fi.merchant');

        $gateway->setApiKey($merchant['Stripe']['secretKey']);

        return $gateway;
    }

    public static function setPurchaseParameters($purchaseParameters, $params)
    {
        $purchaseParameters['token'] = $params['post']['stripeToken'];

        return $purchaseParameters;
    }

    public static function isRedirect()
    {
        return false;
    }

    public static function isNotify()
    {
        return false;
    }

    public static function getValidator($input)
    {
        $config = config('fi.merchant.Stripe');

        $rules = [];

        if ($config['requireBillingName'] == 2)
        {
            $rules['name'] = 'required';
        }

        if ($config['requireBillingAddress'] == 2)
        {
            $rules['address_line1'] = 'required';
        }

        if ($config['requireBillingCity'] == 2)
        {
            $rules['address_city'] = 'required';
        }

        if ($config['requireBillingState'] == 2)
        {
            $rules['address_state'] = 'required';
        }

        if ($config['requireBillingZip'] == 2)
        {
            $rules['address_zip'] = 'required';
        }

        return Validator::make($input, $rules);
    }
}
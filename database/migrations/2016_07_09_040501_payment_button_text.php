<?php

use Illuminate\Database\Migrations\Migration;

class PaymentButtonText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settingRepository = app('FI\Modules\Settings\Repositories\SettingRepository');
        $merchantConfig    = json_decode($settingRepository->get('merchant'), true);

        $merchantConfig['PayPalExpress']['paymentButtonText'] = 'Pay with PayPal';
        $merchantConfig['Stripe']['paymentButtonText']        = 'Pay with Stripe';
        $merchantConfig['Mollie']['paymentButtonText']        = 'Pay with Mollie';

        $settingRepository->save('merchant', json_encode($merchantConfig));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

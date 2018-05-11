<?php

use Illuminate\Database\Migrations\Migration;

class StripeRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settingRepository = App::make('FI\Modules\Settings\Repositories\SettingRepository');
        $merchantConfig    = json_decode($settingRepository->get('merchant'), true);

        $merchantConfig['Stripe']['requireBillingName'] = 0;
        $merchantConfig['Stripe']['requireBillingAddress'] = 0;
        $merchantConfig['Stripe']['requireBillingCity'] = 0;
        $merchantConfig['Stripe']['requireBillingState'] = 0;
        $merchantConfig['Stripe']['requireBillingZip'] = 0;

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

<?php

use Illuminate\Database\Migrations\Migration;

class PaypalTestMode extends Migration
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

        $merchantConfig['PayPalExpress']['testMode'] = 0;

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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DecimalSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app('FI\Modules\Settings\Repositories\SettingRepository')->save('amountDecimals', 2);
        app('FI\Modules\Settings\Repositories\SettingRepository')->save('roundTaxDecimals', 3);
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

<?php

use FI\Modules\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class RecentClientActivityWidget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settings = app('FI\Modules\Settings\Repositories\SettingRepository');

        $maxDisplayOrder = Setting::where('setting_key', 'like', 'widgetDisplayOrder%')->max('setting_value');

        $settings->save('widgetEnabledClientActivity', 0);
        $settings->save('widgetDisplayOrderClientActivity', ($maxDisplayOrder + 1));
        $settings->save('widgetColumnWidthClientActivity', 4);
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

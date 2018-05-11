<?php

use Illuminate\Database\Migrations\Migration;

class Version20171 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        deleteTempFiles();
        deleteViewCache();

        App::make('FI\Modules\Settings\Repositories\SettingRepository')->save('version', '2017-1');
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

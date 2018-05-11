<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemLookupTaxRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_lookups', function(Blueprint $table)
        {
            $table->integer('tax_rate_id')->default(0);
            $table->integer('tax_rate_2_id')->default(0);

            $table->index('tax_rate_id');
            $table->index('tax_rate_2_id');
        });
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

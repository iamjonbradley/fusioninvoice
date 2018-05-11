<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Discount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function(Blueprint $table)
        {
            $table->decimal('discount', 15, 2)->default(0.00);
        });

        Schema::table('quotes', function(Blueprint $table)
        {
            $table->decimal('discount', 15, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function(Blueprint $table)
        {
            $table->dropColumn('discount');
        });

        Schema::table('quotes', function(Blueprint $table)
        {
            $table->dropColumn('discount');
        });
    }
}

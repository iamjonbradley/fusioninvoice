<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiscountAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_amounts', function(Blueprint $table)
        {
            $table->decimal('discount', 15, 2)->default(0.00)->after('subtotal');
        });

        Schema::table('quote_amounts', function(Blueprint $table)
        {
            $table->decimal('discount', 15, 2)->default(0.00)->after('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_amounts', function(Blueprint $table)
        {
            $table->dropColumn('discount');
        });

        Schema::table('quote_amounts', function(Blueprint $table)
        {
            $table->dropColumn('discount');
        });
    }
}

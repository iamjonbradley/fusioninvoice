<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyProfilesFks extends Migration
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
            $table->integer('company_profile_id');

            $table->index('company_profile_id');
        });

        Schema::table('quotes', function(Blueprint $table)
        {
            $table->integer('company_profile_id');

            $table->index('company_profile_id');
        });

        Schema::table('expenses', function(Blueprint $table)
        {
            $table->integer('company_profile_id');

            $table->index('company_profile_id');
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
            $table->dropColumn('company_profile_id');
        });

        Schema::table('quotes', function(Blueprint $table)
        {
            $table->dropColumn('company_profile_id');
        });

        Schema::table('expenses', function(Blueprint $table)
        {
            $table->dropColumn('company_profile_id');
        });
    }
}

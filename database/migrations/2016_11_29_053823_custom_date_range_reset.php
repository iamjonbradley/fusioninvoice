<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomDateRangeReset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settingRepository = app('FI\Modules\Settings\Repositories\SettingRepository');

        if ($settingRepository->get('widgetInvoiceSummaryDashboardTotals') == 'custom_date_range')
        {
            $settingRepository->save('widgetInvoiceSummaryDashboardTotals', 'year_to_date');
            $settingRepository->delete('widgetInvoiceSummaryDashboardTotalsFromDate');
            $settingRepository->delete('widgetInvoiceSummaryDashboardTotalsToDate');
        }

        if ($settingRepository->get('widgetQuoteSummaryDashboardTotals') == 'custom_date_range')
        {
            $settingRepository->save('widgetQuoteSummaryDashboardTotals', 'year_to_date');
            $settingRepository->delete('widgetQuoteSummaryDashboardTotalsFromDate');
            $settingRepository->delete('widgetQuoteSummaryDashboardTotalsToDate');
        }
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

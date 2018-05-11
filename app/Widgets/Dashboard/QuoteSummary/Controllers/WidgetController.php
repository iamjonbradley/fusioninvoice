<?php

namespace FI\Widgets\Dashboard\QuoteSummary\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Settings\Repositories\SettingRepository;

class WidgetController extends Controller
{
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function renderPartial()
    {
        $this->settingRepository->save('widgetQuoteSummaryDashboardTotals', request('widgetQuoteSummaryDashboardTotals'));

        if (request()->has('widgetQuoteSummaryDashboardTotalsFromDate'))
        {
            $this->settingRepository->save('widgetQuoteSummaryDashboardTotalsFromDate', request('widgetQuoteSummaryDashboardTotalsFromDate'));
        }

        if (request()->has('widgetQuoteSummaryDashboardTotalsToDate'))
        {
            $this->settingRepository->save('widgetQuoteSummaryDashboardTotalsToDate', request('widgetQuoteSummaryDashboardTotalsToDate'));
        }

        $this->settingRepository->setAll();

        return view('QuoteSummaryWidget');
    }
}
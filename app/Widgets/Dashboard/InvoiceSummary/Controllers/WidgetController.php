<?php

namespace FI\Widgets\Dashboard\InvoiceSummary\Controllers;

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
        $this->settingRepository->save('widgetInvoiceSummaryDashboardTotals', request('widgetInvoiceSummaryDashboardTotals'));

        if (request()->has('widgetInvoiceSummaryDashboardTotalsFromDate'))
        {
            $this->settingRepository->save('widgetInvoiceSummaryDashboardTotalsFromDate', request('widgetInvoiceSummaryDashboardTotalsFromDate'));
        }

        if (request()->has('widgetInvoiceSummaryDashboardTotalsToDate'))
        {
            $this->settingRepository->save('widgetInvoiceSummaryDashboardTotalsToDate', request('widgetInvoiceSummaryDashboardTotalsToDate'));
        }

        $this->settingRepository->setAll();

        return view('InvoiceSummaryWidget');
    }
}
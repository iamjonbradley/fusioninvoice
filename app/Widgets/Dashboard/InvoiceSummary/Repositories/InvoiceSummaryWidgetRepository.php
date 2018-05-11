<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Widgets\Dashboard\InvoiceSummary\Repositories;

use FI\Modules\Invoices\Models\InvoiceAmount;
use FI\Modules\Payments\Models\Payment;
use FI\Support\CurrencyFormatter;
use Illuminate\Support\Facades\DB;

class InvoiceSummaryWidgetRepository
{
    public function getInvoiceTotalDraft()
    {
        return CurrencyFormatter::format(InvoiceAmount::join('invoices', 'invoices.id', '=', 'invoice_amounts.invoice_id')
            ->whereHas('invoice', function ($q)
            {
                $q->draft();
                switch (config('fi.widgetInvoiceSummaryDashboardTotals'))
                {
                    case 'year_to_date':
                        $q->yearToDate();
                        break;
                    case 'this_quarter':
                        $q->thisQuarter();
                        break;
                    case 'custom_date_range':
                        $q->dateRange(config('fi.widgetInvoiceSummaryDashboardTotalsFromDate'), config('fi.widgetInvoiceSummaryDashboardTotalsToDate'));
                        break;
                }
            })->sum(DB::raw('balance / exchange_rate')));
    }

    public function getInvoiceTotalSent()
    {
        return CurrencyFormatter::format(InvoiceAmount::join('invoices', 'invoices.id', '=', 'invoice_amounts.invoice_id')
            ->whereHas('invoice', function ($q)
            {
                $q->sent();
                switch (config('fi.widgetInvoiceSummaryDashboardTotals'))
                {
                    case 'year_to_date':
                        $q->yearToDate();
                        break;
                    case 'this_quarter':
                        $q->thisQuarter();
                        break;
                    case 'custom_date_range':
                        $q->dateRange(config('fi.widgetInvoiceSummaryDashboardTotalsFromDate'), config('fi.widgetInvoiceSummaryDashboardTotalsToDate'));
                        break;
                }
            })->sum(DB::raw('balance / exchange_rate')));
    }

    public function getInvoiceTotalPaid()
    {
        $payments = Payment::join('invoices', 'invoices.id', '=', 'payments.invoice_id');

        switch (config('fi.widgetInvoiceSummaryDashboardTotals'))
        {
            case 'year_to_date':
                $payments->yearToDate();
                break;
            case 'this_quarter':
                $payments->thisQuarter();
                break;
            case 'custom_date_range':
                $payments->dateRange(config('fi.widgetInvoiceSummaryDashboardTotalsFromDate'), config('fi.widgetInvoiceSummaryDashboardTotalsToDate'));
                break;
        }

        return CurrencyFormatter::format($payments->sum(DB::raw('amount / exchange_rate')));
    }

    public function getInvoiceTotalOverdue()
    {
        return CurrencyFormatter::format(InvoiceAmount::join('invoices', 'invoices.id', '=', 'invoice_amounts.invoice_id')
            ->whereHas('invoice', function ($q)
            {
                $q->overdue();
                switch (config('fi.widgetInvoiceSummaryDashboardTotals'))
                {
                    case 'year_to_date':
                        $q->yearToDate();
                        break;
                    case 'this_quarter':
                        $q->thisQuarter();
                        break;
                    case 'custom_date_range':
                        $q->dateRange(config('fi.widgetInvoiceSummaryDashboardTotalsFromDate'), config('fi.widgetInvoiceSummaryDashboardTotalsToDate'));
                        break;
                }
            })->sum(DB::raw('balance / exchange_rate')));
    }
}
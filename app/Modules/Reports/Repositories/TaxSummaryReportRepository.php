<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Repositories;

use FI\Modules\Invoices\Models\Invoice;
use FI\Support\CurrencyFormatter;
use FI\Support\DateFormatter;
use FI\Support\NumberFormatter;

class TaxSummaryReportRepository
{
    public function getResults($fromDate, $toDate, $companyProfileId = null)
    {
        $results = [
            'from_date' => DateFormatter::format($fromDate),
            'to_date'   => DateFormatter::format($toDate),
            'records'   => [],
        ];

        $invoices = Invoice::with(['items.taxRate', 'items.taxRate2', 'items.amount'])
            ->where('created_at', '>=', $fromDate)
            ->where('created_at', '<=', $toDate);

        if ($companyProfileId)
        {
            $invoices->where('company_profile_id', $companyProfileId);
        }

        $invoices = $invoices->get();

        foreach ($invoices as $invoice)
        {
            foreach ($invoice->items as $invoiceItem)
            {
                if ($invoiceItem->tax_rate_id)
                {
                    $key = $invoiceItem->taxRate->name . ' (' . NumberFormatter::format($invoiceItem->taxRate->percent, null, 3) . '%)';

                    if (isset($results['records'][$key]['taxable_amount']))
                    {
                        $results['records'][$key]['taxable_amount'] += $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        $results['records'][$key]['taxes'] += $invoiceItem->amount->tax_1 / $invoice->exchange_rate;
                    }
                    else
                    {
                        $results['records'][$key]['taxable_amount'] = $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        $results['records'][$key]['taxes']          = $invoiceItem->amount->tax_1 / $invoice->exchange_rate;
                    }
                }

                if ($invoiceItem->tax_rate_2_id)
                {
                    $key = $invoiceItem->taxRate2->name . ' (' . NumberFormatter::format($invoiceItem->taxRate2->percent, null, 3) . '%)';

                    if (isset($results['records'][$key]['taxable_amount']))
                    {
                        if ($invoiceItem->taxRate2->is_compound)
                        {
                            $results['records'][$key]['taxable_amount'] += ($invoiceItem->amount->subtotal + $invoiceItem->amount->tax_1) / $invoice->exchange_rate;
                        }
                        else
                        {
                            $results['records'][$key]['taxable_amount'] += $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        }

                        $results['records'][$key]['taxes'] += $invoiceItem->amount->tax_2 / $invoice->exchange_rate;
                    }
                    else
                    {
                        if ($invoiceItem->taxRate2->is_compound)
                        {
                            $results['records'][$key]['taxable_amount'] = ($invoiceItem->amount->subtotal + $invoiceItem->amount->tax_2) / $invoice->exchange_rate;
                        }
                        else
                        {
                            $results['records'][$key]['taxable_amount'] = $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        }

                        $results['records'][$key]['taxes'] = $invoiceItem->amount->tax_2 / $invoice->exchange_rate;
                    }
                }

            }

        }

        foreach ($results['records'] as $key => $result)
        {
            $results['records'][$key]['taxable_amount'] = CurrencyFormatter::format($result['taxable_amount']);
            $results['records'][$key]['taxes']          = CurrencyFormatter::format($result['taxes']);
        }

        return $results;
    }
}
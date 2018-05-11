<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\RecurringInvoices\Repositories;

use FI\Events\InvoiceCreatedRecurring;
use FI\Events\InvoiceModified;
use FI\Events\RecurringInvoiceCreated;
use FI\Events\RecurringInvoiceModified;
use FI\Modules\CustomFields\Repositories\CustomFieldRepository;
use FI\Modules\CustomFields\Repositories\InvoiceCustomRepository;
use FI\Modules\CustomFields\Repositories\RecurringInvoiceCustomRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Invoices\Repositories\InvoiceItemRepository;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Modules\RecurringInvoices\Models\RecurringInvoice;
use FI\Support\BaseRepository;
use FI\Support\DateFormatter;
use FI\Support\NumberFormatter;

class RecurringInvoiceRepository extends BaseRepository
{
    private $customFieldRepository;
    private $groupRepository;
    private $invoiceRepository;
    private $invoiceItemRepository;
    private $recurringInvoiceItemRepository;
    private $recurringInvoiceCustomRepository;

    public function __construct(
        CustomFieldRepository $customFieldRepository,
        InvoiceRepository $invoiceRepository,
        InvoiceItemRepository $invoiceItemRepository,
        GroupRepository $groupRepository,
        RecurringInvoiceCustomRepository $recurringInvoiceCustomRepository,
        RecurringInvoiceItemRepository $recurringInvoiceItemRepository
    )
    {
        $this->customFieldRepository            = $customFieldRepository;
        $this->invoiceRepository                = $invoiceRepository;
        $this->invoiceItemRepository            = $invoiceItemRepository;
        $this->groupRepository                  = $groupRepository;
        $this->recurringInvoiceCustomRepository = $recurringInvoiceCustomRepository;
        $this->recurringInvoiceItemRepository   = $recurringInvoiceItemRepository;
    }

    public function paginate($status, $keywords = null, $clientId = null, $companyProfileId = null)
    {
        return RecurringInvoice::select('recurring_invoices.*')
            ->join('clients', 'clients.id', '=', 'recurring_invoices.client_id')
            ->join('recurring_invoice_amounts', 'recurring_invoice_amounts.recurring_invoice_id', '=', 'recurring_invoices.id')
            ->with($this->with)
            ->keywords($keywords)
            ->clientId($clientId)
            ->status($status)
            ->companyProfileId($companyProfileId)
            ->sortable(['next_date' => 'desc', 'id' => 'desc'])
            ->paginate(config('fi.resultsPerPage'));
    }

    public function find($id)
    {
        return RecurringInvoice::with($this->with)->find($id);
    }

    public function create($input, $client, $unformat = true)
    {
        $groupId  = (isset($input['group_id'])) ? $input['group_id'] : config('fi.invoiceGroup');
        $summary  = (isset($input['summary']) ? $input['summary'] : '');
        $discount = (isset($input['discount']) ? $input['discount'] : 0);
        $terms    = (isset($input['terms']) ? $input['terms'] : config('fi.invoiceTerms'));
        $footer   = (isset($input['footer']) ? $input['footer'] : config('fi.invoiceFooter'));
        $nextDate = (($unformat) ? DateFormatter::unformat($input['next_date']) : $input['next_date']);

        if (isset($input['stop_date']) and $input['stop_date'])
        {
            $stopDate = (($unformat) ? DateFormatter::unformat($input['stop_date']) : $input['stop_date']);
        }
        else
        {
            $stopDate = '0000-00-00';
        }

        $recurringInvoice = RecurringInvoice::create([
            'company_profile_id'  => $input['company_profile_id'],
            'client_id'           => $client->id,
            'group_id'            => $groupId,
            'user_id'             => $input['user_id'],
            'terms'               => $terms,
            'footer'              => $footer,
            'currency_code'       => $client->currency_code,
            'exchange_rate'       => '',
            'template'            => $client->invoice_template,
            'summary'             => $summary,
            'discount'            => $discount,
            'next_date'           => $nextDate,
            'stop_date'           => $stopDate,
            'recurring_frequency' => $input['recurring_frequency'],
            'recurring_period'    => $input['recurring_period'],
        ]);

        event(new RecurringInvoiceCreated($recurringInvoice));

        return $recurringInvoice;
    }

    public function update($input, $id)
    {
        $nextDate = DateFormatter::unformat($input['next_date']);
        $stopDate = (isset($input['stop_date']) and $input['stop_date']) ? DateFormatter::unformat($input['stop_date']) : '0000-00-00';

        $custom = (array)json_decode($input['custom']);

        unset($input['custom']);

        $recurringInvoiceInput = [
            'next_date'           => $nextDate,
            'stop_date'           => $stopDate,
            'recurring_frequency' => $input['recurring_frequency'],
            'recurring_period'    => $input['recurring_period'],
            'terms'               => $input['terms'],
            'footer'              => $input['footer'],
            'currency_code'       => $input['currency_code'],
            'exchange_rate'       => $input['exchange_rate'],
            'template'            => $input['template'],
            'summary'             => $input['summary'],
            'discount'            => NumberFormatter::unformat($input['discount']),
        ];

        $recurringInvoice = RecurringInvoice::find($id);

        $recurringInvoice->fill($recurringInvoiceInput);

        $recurringInvoice->save();

        $this->recurringInvoiceCustomRepository->save($custom, $id);

        $this->recurringInvoiceItemRepository->saveItems(
            json_decode($input['items'], true),
            isset($input['apply_exchange_rate']),
            $input['exchange_rate']
        );

        event(new RecurringInvoiceModified($recurringInvoice));

        return $recurringInvoice;
    }

    public function recurInvoices()
    {
        $recurringInvoices = RecurringInvoice::recurNow()->get();

        foreach ($recurringInvoices as $recurringInvoice)
        {
            $invoiceData = [
                'company_profile_id' => $recurringInvoice->company_profile_id,
                'created_at'         => $recurringInvoice->next_date,
                'group_id'           => $recurringInvoice->group_id,
                'user_id'            => $recurringInvoice->user_id,
                'currency_code'      => $recurringInvoice->currency_code,
                'template'           => $recurringInvoice->template,
                'terms'              => $recurringInvoice->terms,
                'footer'             => $recurringInvoice->footer,
                'summary'            => $recurringInvoice->summary,
                'discount'           => $recurringInvoice->discount,
            ];

            $invoice = $this->invoiceRepository->create($invoiceData, $recurringInvoice->client, false);

            $this->customFieldRepository->copyCustomFieldValues($recurringInvoice->custom, 'recurring_invoices', 'invoices', new InvoiceCustomRepository(), $invoice->id);

            foreach ($recurringInvoice->recurringInvoiceItems as $item)
            {
                $itemData = [
                    'invoice_id'         => $invoice->id,
                    'item_name'          => $item->name,
                    'item_description'   => $item->description,
                    'item_quantity'      => $item->quantity,
                    'item_price'         => $item->price,
                    'item_tax_rate_id'   => $item->tax_rate_id,
                    'item_tax_rate_2_id' => $item->tax_rate_2_id,
                    'item_order'         => $item->display_order,
                ];

                $this->invoiceItemRepository->saveItem($itemData, false, 1, false);
            }

            if ($recurringInvoice->stop_date == '0000-00-00' or ($recurringInvoice->stop_date !== '0000-00-00' and ($recurringInvoice->next_date < $recurringInvoice->stop_date)))
            {
                $nextDate = DateFormatter::incrementDate(substr($recurringInvoice->next_date, 0, 10), $recurringInvoice->recurring_period, $recurringInvoice->recurring_frequency);
            }
            else
            {
                $nextDate = '0000-00-00';
            }

            $recurringInvoice->next_date = $nextDate;
            $recurringInvoice->save();

            event(new InvoiceModified($invoice));

            event(new InvoiceCreatedRecurring($invoice));
        }

        return count($recurringInvoices);
    }

    public function updateRaw($input, $id)
    {
        $recurringInvoice = RecurringInvoice::find($id);

        $recurringInvoice->fill($input);

        $recurringInvoice->save();

        return $recurringInvoice;
    }

    public function delete($id)
    {
        RecurringInvoice::destroy($id);
    }
}
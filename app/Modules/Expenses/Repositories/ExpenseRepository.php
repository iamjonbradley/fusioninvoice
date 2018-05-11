<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Expenses\Repositories;

use FI\Modules\Clients\Models\Client;
use FI\Modules\Expenses\Models\Expense;
use FI\Modules\Expenses\Models\ExpenseCategory;
use FI\Modules\Expenses\Models\ExpenseVendor;
use FI\Support\DateFormatter;
use FI\Support\NumberFormatter;

class ExpenseRepository
{
    protected function buildQuery()
    {
        return Expense::select('expenses.*', 'expense_categories.name AS category_name',
            'expense_vendors.name AS vendor_name', 'clients.name AS client_name')
            ->join('expense_categories', 'expense_categories.id', '=', 'expenses.category_id')
            ->leftJoin('expense_vendors', 'expense_vendors.id', '=', 'expenses.vendor_id')
            ->leftJoin('clients', 'clients.id', '=', 'expenses.client_id');
    }

    public function find($id)
    {
        return $this->buildQuery()->find($id);
    }

    public function paginate($filter = null, $categoryId = null, $vendorId = null, $status = null, $companyProfileId = null)
    {
        return $this->buildQuery()
            ->keywords($filter)
            ->categoryId($categoryId)
            ->vendorId($vendorId)
            ->status($status)
            ->companyProfileId($companyProfileId)
            ->sortable(['expense_date' => 'desc'])
            ->paginate(config('fi.defaultNumPerPage'));
    }

    public function create($input)
    {
        return Expense::create($this->getRecord($input));
    }

    public function update($input, $id)
    {
        $expense = Expense::find($id);

        $expense->fill($this->getRecord($input, false));

        $expense->save();

        return $expense;
    }

    public function updateRaw($input, $id)
    {
        $expense = Expense::find($id);

        $expense->fill($input);

        $expense->save();

        return $expense;
    }

    public function delete($id)
    {
        Expense::destroy($id);
    }

    private function getRecord($input, $newRecord = true)
    {
        $record = [
            'company_profile_id' => $input['company_profile_id'],
            'category_id'        => ExpenseCategory::firstOrCreate(['name' => $input['category_name']])->id,
            'amount'             => NumberFormatter::unformat($input['amount']),
            'expense_date'       => DateFormatter::unformat($input['expense_date']),
            'description'        => (isset($input['description']) ? $input['description'] : ''),
        ];

        if ($newRecord)
        {
            $record['user_id'] = $input['user_id'];
        }

        if (isset($input['vendor_name']) and $input['vendor_name'])
        {
            $record['vendor_id'] = ExpenseVendor::firstOrCreate(['name' => $input['vendor_name']])->id;
        }
        else
        {
            $record['vendor_id'] = 0;
        }

        if (isset($input['client_name']) and $input['client_name'])
        {
            $record['client_id'] = Client::firstOrCreate(['unique_name' => $input['client_name']])->id;
        }
        else
        {
            $record['client_id'] = 0;
        }

        return $record;
    }
}
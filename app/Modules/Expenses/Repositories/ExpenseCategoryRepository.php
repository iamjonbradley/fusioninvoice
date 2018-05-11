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

use FI\Modules\Expenses\Models\ExpenseCategory;

class ExpenseCategoryRepository
{
    public function firstOrCreate($name)
    {
        return ExpenseCateogory::firstOrCreate(['name' => $name]);
    }

    public function lists()
    {
        return ExpenseCategory::whereIn('id', function ($query)
        {
            $query->select('category_id')->distinct()->from('expenses');
        })->orderBy('name')
            ->lists('name', 'id')
            ->all();
    }

    /**
     * Provides a json encoded array of matching categories.
     *
     * @param  string $name
     * @return json
     */
    public function lookupByName($name)
    {
        $expenses = ExpenseCategory::select('name')
            ->where('name', 'like', '%' . $name . '%')
            ->orderBy('name')
            ->get();

        $return = [];

        foreach ($expenses as $expense)
        {
            $return[]['value'] = $expense->name;
        }

        return json_encode($return);
    }
}
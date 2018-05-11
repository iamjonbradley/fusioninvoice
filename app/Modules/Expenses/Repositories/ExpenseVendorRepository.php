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

use FI\Modules\Expenses\Models\ExpenseVendor;

class ExpenseVendorRepository
{
    public function lists()
    {
        return ExpenseVendor::whereIn('id', function ($query)
        {
            $query->select('vendor_id')->distinct()->from('expenses');
        })->orderBy('name')
            ->lists('name', 'id')
            ->all();
    }

    /**
     * Provides a json encoded array of matching vendors.
     *
     * @param  string $name
     * @return json
     */
    public function lookupByName($name)
    {
        $expenses = ExpenseVendor::select('name')
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
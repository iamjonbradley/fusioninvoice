<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Groups\Repositories;

use FI\Modules\Groups\Models\Group;

class GroupRepository
{
    public function all()
    {
        return Group::orderBy('name')->all();
    }

    public function paginate()
    {
        return Group::sortable(['name' => 'asc'])->paginate(config('fi.resultsPerPage'));
    }

    public function find($id)
    {
        return Group::find($id);
    }

    public function findIdByName($name)
    {
        if ($group = Group::where('name', $name)->first())
        {
            return $group->id;
        }

        return null;
    }

    public function generateNumber($id)
    {
        $group = Group::find($id);

        // Only check for resets if this group has been used.
        if ($group->last_id <> 0)
        {
            // Check for yearly reset.
            if ($group->reset_number == 1)
            {
                if ($group->last_year <> date('Y'))
                {
                    $group->next_id = 1;
                    $group->save();
                }
            }
            // Check for monthly reset.
            elseif ($group->reset_number == 2)
            {
                if ($group->last_month <> date('m') or $group->last_year <> date('Y'))
                {
                    $group->next_id = 1;
                    $group->save();
                }
            }
            // Check for weekly reset.
            elseif ($group->reset_number == 3)
            {
                if ($group->last_week <> date('W') or $group->last_month <> date('m') or $group->last_year <> date('Y'))
                {
                    $group->next_id = 1;
                    $group->save();
                }
            }
        }

        $number = $group->format;

        $number = str_replace('{NUMBER}', str_pad($group->next_id, $group->left_pad, '0', STR_PAD_LEFT), $number);
        $number = str_replace('{YEAR}', date('Y'), $number);
        $number = str_replace('{MONTH}', date('m'), $number);
        $number = str_replace('{WEEK}', date('W'), $number);

        $group->last_id    = $group->next_id;
        $group->last_week  = date('W');
        $group->last_month = date('m');
        $group->last_year  = date('Y');
        $group->save();

        return $number;
    }

    public function incrementNextId($id)
    {
        $group          = Group::find($id);
        $group->next_id = $group->next_id + 1;
        $group->save();
    }

    public function lists()
    {
        return Group::orderBy('name')->lists('name', 'id')->all();
    }

    public function create($input)
    {
        return Group::create($input);
    }

    public function update($input, $id)
    {
        $group = Group::find($id);

        $group->fill($input);

        $group->save();

        return $group;
    }

    public function delete($id)
    {
        Group::destroy($id);
    }
}
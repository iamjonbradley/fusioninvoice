<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CompanyProfiles\Repositories;

use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Expenses\Models\Expense;
use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\Quotes\Models\Quote;

class CompanyProfileRepository
{
    public function find($id)
    {
        return CompanyProfile::find($id);
    }

    public function paginate()
    {
        return CompanyProfile::orderBy('company')->paginate(config('fi.resultsPerPage'));
    }

    public function findIdByName($name)
    {
        if ($companyProfile = CompanyProfile::where('company', $name)->first())
        {
            return $companyProfile->id;
        }

        return null;
    }

    public function lists()
    {
        return CompanyProfile::orderBy('company')->lists('company', 'id')->all();
    }

    public function create($input)
    {
        return CompanyProfile::create($input);
    }

    public function update($input, $id)
    {
        $companyProfile = CompanyProfile::find($id);

        $companyProfile->fill($input);

        $companyProfile->save();

        return $companyProfile;
    }

    public function delete($id)
    {
        if ($this->companyProfileInUse($id))
        {
            return trans('fi.cannot_delete_record_in_use');
        }

        CompanyProfile::destroy($id);

        return trans('fi.record_successfully_deleted');
    }

    public function companyProfileInUse($id)
    {
        if (Invoice::where('company_profile_id', $id)->count())
        {
            return true;
        }

        if (Quote::where('company_profile_id', $id)->count())
        {
            return true;
        }

        if (Expense::where('company_profile_id', $id)->count())
        {
            return true;
        }

        if (config('fi.defaultCompanyProfile') == $id)
        {
            return true;
        }

        return false;
    }
}
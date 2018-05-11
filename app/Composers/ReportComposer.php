<?php

namespace FI\Composers;

use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;

class ReportComposer
{
    public function __construct(CompanyProfileRepository $companyProfileRepository)
    {
        $this->companyProfileRepository = $companyProfileRepository;
    }

    public function compose($view)
    {
        $view->with('companyProfiles', ['' => trans('fi.all_company_profiles')] + $this->companyProfileRepository->lists());
    }
}
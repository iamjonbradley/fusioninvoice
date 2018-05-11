<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CompanyProfiles\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\CompanyProfiles\Validators\CompanyProfileValidator;
use FI\Traits\ReturnUrl;

class CompanyProfileController extends Controller
{
    use ReturnUrl;

    private $companyProfileRepository;

    private $companyProfileValidator;

    public function __construct(CompanyProfileRepository $companyProfileRepository, CompanyProfileValidator $companyProfileValidator)
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->companyProfileValidator  = $companyProfileValidator;
    }

    public function index()
    {
        $this->setReturnUrl();

        $companyProfiles = $this->companyProfileRepository->paginate();

        return view('company_profiles.index')
            ->with('companyProfiles', $companyProfiles);
    }

    public function create()
    {
        return view('company_profiles.form')
            ->with('editMode', false);
    }

    public function store()
    {
        $input = request()->all();

        $validator = $this->companyProfileValidator->getValidator($input);

        if ($validator->fails())
        {
            return redirect()->route('companyProfiles.create')
                ->with('editMode', false)
                ->withErrors($validator)
                ->withInput();
        }

        $this->companyProfileRepository->create($input);

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('fi.record_successfully_created'));
    }

    public function edit($id)
    {
        $companyProfile = $this->companyProfileRepository->find($id);

        return view('company_profiles.form')
            ->with([
                'editMode'            => true,
                'companyProfile'      => $companyProfile,
                'companyProfileInUse' => $this->companyProfileRepository->companyProfileInUse($id),
            ]);
    }

    public function update($id)
    {
        $input = request()->all();

        $validator = $this->companyProfileValidator->getUpdateValidator($input, $id);

        if ($validator->fails())
        {
            return redirect()->route('companyProfiles.edit', [$id])
                ->with('editMode', true)
                ->withErrors($validator)
                ->withInput();
        }

        $this->companyProfileRepository->update($input, $id);

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('fi.record_successfully_updated'));
    }

    public function delete($id)
    {
        $alert = $this->companyProfileRepository->delete($id);

        return redirect()->route('companyProfiles.index')
            ->with('alert', $alert);
    }

    public function ajaxModalLookup()
    {
        return view('company_profiles._modal_lookup')
            ->with('id', request('id'))
            ->with('companyProfiles', $this->companyProfileRepository->lists())
            ->with('refreshFromRoute', request('refresh_from_route'))
            ->with('updateCompanyProfileRoute', request('update_company_profile_route'));
    }
}
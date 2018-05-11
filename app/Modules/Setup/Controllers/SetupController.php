<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Setup\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\Settings\Repositories\SettingRepository;
use FI\Modules\Setup\Validators\SetupValidator;
use FI\Modules\Users\Repositories\UserRepository;
use FI\Support\Migrations;

class SetupController extends Controller
{
    private $companyProfileRepository;
    private $migrations;
    private $settingRepository;
    private $setupValidator;
    private $userRepository;

    public function __construct(
        CompanyProfileRepository $companyProfileRepository,
        Migrations $migrations,
        SettingRepository $settingRepository,
        SetupValidator $setupValidator,
        UserRepository $userRepository
    )
    {
        $this->companyProfileRepository = $companyProfileRepository;
        $this->migrations               = $migrations;
        $this->settingRepository        = $settingRepository;
        $this->userRepository           = $userRepository;
        $this->setupValidator           = $setupValidator;
    }

    public function index()
    {
        return view('setup.index')
            ->with('license', file_get_contents(public_path('LICENSE')));
    }

    public function postIndex()
    {
        $validator = $this->setupValidator->getLicenseValidator(request()->all());

        if ($validator->fails())
        {
            return redirect()->route('setup.index');
        }

        return redirect()->route('setup.prerequisites');
    }

    public function prerequisites()
    {
        $errors          = [];
        $versionRequired = '5.5.9';
        $dbDriver        = config('database.default');
        $dbConfig        = config('database.connections.' . $dbDriver);

        if (version_compare(phpversion(), $versionRequired, '<'))
        {
            $errors[] = sprintf(trans('fi.php_version_error'), $versionRequired);
        }

        if (!$dbConfig['host'] or !$dbConfig['database'] or !$dbConfig['username'] or !$dbConfig['password'])
        {
            $errors[] = trans('fi.database_not_configured');
        }

        if (!$errors)
        {
            return redirect()->route('setup.migration');
        }

        return view('setup.prerequisites')
            ->with('errors', $errors);
    }

    public function migration()
    {
        return view('setup.migration');
    }

    public function postMigration()
    {
        if ($this->migrations->runMigrations(database_path('migrations')))
        {
            return response()->json([], 200);
        }

        return response()->json(['exception' => $this->migrations->getException()->getMessage()], 400);
    }

    public function account()
    {
        if (!$this->userRepository->count())
        {
            return view('setup.account');
        }

        return redirect()->route('setup.complete');
    }

    public function postAccount()
    {
        if (!$this->userRepository->count())
        {
            $input = request()->all();

            $validator = $this->setupValidator->getUserValidator($input);

            if ($validator->fails())
            {
                return redirect()->route('setup.account')
                    ->withErrors($validator)
                    ->withInput();
            }

            unset($input['user']['password_confirmation']);

            $this->userRepository->create($input['user']);

            $companyProfile = $this->companyProfileRepository->create($input['company_profile']);

            $this->settingRepository->save('defaultCompanyProfile', $companyProfile->id);
        }

        return redirect()->route('setup.complete');
    }

    public function complete()
    {
        return view('setup.complete');
    }
}
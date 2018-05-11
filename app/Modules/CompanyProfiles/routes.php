<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => 'auth.admin', 'namespace' => 'FI\Modules\CompanyProfiles\Controllers'], function ()
{
    Route::get('company_profiles', ['uses' => 'CompanyProfileController@index', 'as' => 'companyProfiles.index']);
    Route::get('company_profiles/create', ['uses' => 'CompanyProfileController@create', 'as' => 'companyProfiles.create']);
    Route::get('company_profiles/{companyProfile}/edit', ['uses' => 'CompanyProfileController@edit', 'as' => 'companyProfiles.edit']);
    Route::get('company_profiles/{companyProfile}/delete', ['uses' => 'CompanyProfileController@delete', 'as' => 'companyProfiles.delete']);

    Route::post('company_profiles', ['uses' => 'CompanyProfileController@store', 'as' => 'companyProfiles.store']);
    Route::post('company_profiles/{companyProfile}', ['uses' => 'CompanyProfileController@update', 'as' => 'companyProfiles.update']);

    Route::post('company_profiles/ajax/modal_lookup', ['uses' => 'CompanyProfileController@ajaxModalLookup', 'as' => 'companyProfiles.ajax.modalLookup']);
});
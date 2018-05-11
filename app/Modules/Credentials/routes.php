<?php

/**
 * This file is an addon to FusionInvoice by Amber Orchard.
 *
 * (c) Amber Orchard, LLC <jonathan@amberorchard.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => 'auth.admin', 'prefix' => 'credentials', 'namespace' => 'FI\Modules\Credentials\Controllers'], function ()
{
    Route::get('/', ['uses' => 'CredentialController@index', 'as' => 'credentials.index']);

    Route::get('create', ['uses' => 'CredentialCreateController@create', 'as' => 'credentials.create']);
    Route::post('create', ['uses' => 'CredentialCreateController@store', 'as' => 'credentials.store']);

    Route::get('{id}', ['uses' => 'CredentialController@show', 'as' => 'credentials.show']);

    Route::get('{id}/edit', ['uses' => 'CredentialEditController@edit', 'as' => 'credentials.edit']);
    Route::post('{id}/edit', ['uses' => 'CredentialEditController@update', 'as' => 'credentials.update']);
    
    Route::get('{id}/delete', ['uses' => 'CredentialController@delete', 'as' => 'credentials.delete']);


    Route::post('create/ajax', ['uses' => 'CredentialCreateController@ajax_store', 'as' => 'credentials.create.ajax']);
    Route::post('/delete/ajax', ['uses' => 'CredentialController@ajax_delete', 'as' => 'credentials.delete.ajax']);
});
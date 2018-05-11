<?php
/**
 * This file is an addon to FusionInvoice by Amber Orchard.
 *
 * (c) Amber Orchard, LLC <jonathan@amberorchard.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
?>
@extends('layouts.master')

@section('head')
    @include('layouts._datepicker')
    @include('layouts._typeahead')
    @include('clients._js_lookup')
@stop


@section('content')

    @if ($editMode == true)
        {!! Form::model($credential, ['route' => ['credentials.update', $credential->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'credentials.store', 'files' => true]) !!}
    @endif

    {!! Form::hidden('user_id', auth()->user()->id) !!}

    @if ($editMode == true)
        {!! Form::hidden('client_id', $credential->client_id) !!}
    @endif

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('fi.credential_form') }}
        </h1>
        <div class="pull-right">
            {!! Form::submit(trans('fi.save'), ['class' => 'btn btn-primary btn-sm']) !!}
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">
        @include('layouts._alerts')

        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-body">

                        <div class="row">
                            @if ($editMode == false)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* {{ trans('fi.client') }}: </label>
                                    {!! Form::text('client_name', null, ['id' => 'client_name', 'class' => 'form-control client-lookup']) !!}
                                </div>
                            </div>
                            @else
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* {{ trans('fi.client') }}: </label>
                                    <br />
                                    {{ $credential->client->name }}
                                </div>
                            </div>
                            @endif

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* {{ trans('fi.credential_type') }}: </label>
                                    {!! Form::select('credential_type', $types, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* {{ trans('fi.name') }}: </label>
                                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label>* {{ trans('fi.credential_details') }}: </label>
                            {!! Form::textarea('details', null, ['id' => 'details', 'class' => 'form-control']) !!}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {!! Form::close() !!}
@stop
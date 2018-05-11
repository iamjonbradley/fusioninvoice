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

@section('javascript')
    @include('invoices._js_index')
@stop

@section('content')

    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.credential') }}</h1>

        <div class="pull-right">
            <a href="{{ route('credentials.create') }}" class="btn btn-primary btn-margin-left"><i class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>{!! Sortable::link('client', trans('fi.client_name')) !!}</th>
                                <th>{!! Sortable::link('credential_type', trans('fi.credential_type')) !!}</th>
                                <th>{!! Sortable::link('name', trans('fi.name')) !!}</th>
                                <th>{{ trans('fi.options') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($credentials as $credential)
                                <tr>
                                    <td><a href="{{ route('clients.show', [$credential->client_id]) }}">{{ $credential->client_name }}</a></td>
                                    <td>{{ $credential->credential_type }}</td>
                                    <td>{{ $credential->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                {{ trans('fi.options') }} <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{ route('credentials.show', [$credential->id]) }}" id="view-credential-{{ $credential->id }}"><i class="fa fa-search"></i> {{ trans('fi.view') }}</a></li>
                                                <li><a href="{{ route('credentials.edit', [$credential->id]) }}" id="edit-credential-{{ $credential->id }}"><i class="fa fa-edit"></i> {{ trans('fi.edit') }}</a></li>
                                                <li><a href="{{ route('credentials.delete', [$credential->id]) }}" id="delete-credential-{{ $credential->id }}" onclick="return confirm('{{ trans('fi.credential_delete_warning') }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>

                <div class="pull-right">
                    {!! $credentials->appends(request()->except('page'))->render() !!}
                </div>

            </div>

        </div>

    </section>

@stop
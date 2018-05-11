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

@section('content')

    <section class="content-header">
        <h1 class="pull-left">
            <strong>Credential: </strong> {{ $credential->name }}
        </h1>
        <div class="pull-right">
            <a href="{{ route('credentials.edit', [$credential->id]) }}" class="btn btn-default">{{ trans('fi.edit') }}</a>
            <a class="btn btn-default" href="{{ route('credentials.delete', [$credential->id]) }}" onclick="return confirm('{{ trans('fi.credential_delete_warning') }}');"><i class="fa fa-trash"></i> {{ trans('fi.delete') }}</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-xs-12">

                <div class="nav-tabs-custom">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-details">{{ trans('fi.details') }}</a></li>
                    </ul>
                    <div class="tab-content">

                        <div id="tab-details" class="tab-pane active">

                            <div class="row">

                                <div class="col-md-12">

                                    <table class="table table-striped">
                                        <tr>
                                            <td class="col-md-2">{{ trans('fi.credential_type') }}</td>
                                            <td class="col-md-10">{!! $credential->credential_type !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-2">{{ trans('fi.details') }}</td>
                                            <td class="col-md-10">{!! $credential->details !!}</td>
                                        </tr>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>

@stop
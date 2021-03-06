@extends('layouts.master')

@section('javascript')
    @include('invoices._js_index')
@stop

@section('content')

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('fi.invoices') }}
        </h1>

        <div class="pull-right">
            <div class="btn-group">
                {!! Form::open(['method' => 'GET', 'id' => 'filter']) !!}
                {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'invoice_filter_options form-control inline']) !!}
                {!! Form::select('status', $statuses, request('status'), ['class' => 'invoice_filter_options form-control inline']) !!}
                {!! Form::close() !!}
            </div>
            <a href="javascript:void(0)" class="btn btn-primary create-invoice"><i class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
        </div>

        <div class="clearfix"></div>

    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">
                        @include('invoices._table')
                    </div>

                </div>

                <div class="pull-right">
                    {!! $invoices->appends(request()->except('page'))->render() !!}
                </div>

            </div>

        </div>

    </section>

@stop
@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($companyProfile, ['route' => ['companyProfiles.update', $companyProfile->id]]) !!}
    @else
        {!! Form::open(['route' => 'companyProfiles.store']) !!}
    @endif

    <section class="content-header">
        <h1 class="pull-left">
            {{ trans('fi.company_profile_form') }}
        </h1>
        <div class="pull-right">
            {!! Form::submit(trans('fi.save'), ['class' => 'btn btn-primary']) !!}
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">

        @include('layouts._alerts')

        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary">

                    <div class="box-body">

                        <div class="form-group">
                            <label>{{ trans('fi.company') }}: </label>
                            {!! Form::text('company', null, ['id' => 'company', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label>{{ trans('fi.address') }}: </label>
                            {!! Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control', 'rows' => 4]) !!}
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.city') }}: </label>
                                    {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.state') }}: </label>
                                    {!! Form::text('state', null, ['id' => 'state', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.postal_code') }}: </label>
                                    {!! Form::text('zip', null, ['id' => 'zip', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.country') }}: </label>
                                    {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.phone') }}: </label>
                                    {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.fax') }}: </label>
                                    {!! Form::text('fax', null, ['id' => 'fax', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.mobile') }}: </label>
                                    {!! Form::text('mobile', null, ['id' => 'mobile', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('fi.web') }}: </label>
                                    {!! Form::text('web', null, ['id' => 'web', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {!! Form::close() !!}
@stop
@extends('reports.layouts.master')

@section('content')

    <h1 style="margin-bottom: 0;">{{ trans('fi.tax_summary') }}</h1>
    <h3 style="margin-top: 0;">{{ $results['from_date'] }} - {{ $results['to_date'] }}</h3>

    <table class="alternate">

        <thead>
        <tr>
            <th style="width: 50%;">{{ trans('fi.tax_rate') }}</th>
            <th class="amount" style="width: 25%;">{{ trans('fi.taxable_amount') }}</th>
            <th class="amount" style="width: 25%;">{{ trans('fi.taxes') }}</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($results['records'] as $taxRate => $result)
            <tr>
                <td>{{ $taxRate }}</td>
                <td class="amount">{{ $result['taxable_amount'] }}</td>
                <td class="amount">{{ $result['taxes'] }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

@stop
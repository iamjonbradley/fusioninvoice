

<table class="table table-hover credential-list-table">

    <thead>
    <tr>
        <th>{{ trans('fi.credential_type') }}</th>
        <th>{{ trans('fi.name') }}</th>
        <th>{{ trans('fi.options') }}</th>
    </tr>
    </thead>

    <tbody>
   @foreach ($object->credentials()->protect(auth()->user())->orderBy('created_at', 'desc')->get() as $credential)
        @include('credentials._credential')
    @endforeach
    </tbody>

</table>

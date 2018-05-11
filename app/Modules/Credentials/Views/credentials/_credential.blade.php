
        <tr id="row-credential-{{ $credential->id }}">
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
                        <li><a href="#" id="delete-credential-{{ $credential->id }}" class="delete-credential" data-credential-id="{{ $credential->id }}" onclick="return confirm('{{ trans('fi.credential_delete_warning') }}');"><i class="fa fa-trash-o"></i> {{ trans('fi.delete') }}</a></li>
                    </ul>
                </div>
            </td>
        </tr>
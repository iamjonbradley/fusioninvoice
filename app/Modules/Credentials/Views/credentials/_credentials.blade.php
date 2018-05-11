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
<script type="text/javascript">
    $(function () {
        $('#btn-create-credential').click(function () {
            if ($('#credential_content').val() !== '') {
                $.post('{{ route('credentials.create.ajax') }}', {
                    client_id: {{ $object->id }},
                    user_id: {{ auth()->user()->id }},
                    credential_type: $('#credential-credential_type option:selected').val(),
                    name: $('#credential-name').val(),
                    details: $('#credential-details').val()
                }).done(function (response) {
                    var html = $.parseHTML(response);
                    $(html).appendTo('#tab-credentials #credentials-list .credential-list-table');
                    $('#credential-name').val('');
                    $('#credential-details').val('');
                    $('#credential-credential_type').prop('selectedIndex', -1);
                });
            }
        });

        @if (!auth()->user()->client_id)
        $(document).on('click', '.delete-credential', function () {
            credentialId = $(this).data('credential-id');
            console.log(credentialId);
            $('#credential-' + credentialId).hide();
            $.post("{{ route('credentials.delete.ajax') }}", {
                id: credentialId
            }).done(function (response) {
                $('#row-credential-' + credentialId).remove();
            });
        });
        @endif
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid direct-chat direct-chat-warning">
            @if (!isset($hideHeader))
                <div class="box-header">
                    <h3 class="box-title">{{ trans('fi.credentials') }}</h3>
                </div>
            @endif
            <div class="box-body">
                <div class="direct-chat-messages" id="credentials-list">
                    @include('credentials._credentials_list')
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>* {{ trans('fi.credential_type') }}: </label>
                                    {!! Form::select('credential[credential_type]', [null=>'Please Select'] + $credential_types, null, ['id' => 'credential-credential_type', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>* {{ trans('fi.name') }}: </label>
                                    {!! Form::text('credential[name]', null, ['id' => 'credential-name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>* {{ trans('fi.credential_details') }}: </label>
                                    {!! Form::textarea('credential[details]', null, ['id' => 'credential-details', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-flat btn-block"
                                id="btn-create-credential">{{ trans('fi.add_credential') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
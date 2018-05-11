<script type="text/javascript">

    $(function () {

        attachPdf = 0;

        $('#modal-mail-quote').modal({backdrop: 'static'});

        $('#btn-submit-mail-quote').click(function () {

            var $btn = $(this).button('loading');

            if ($('#attach_pdf').prop('checked') == true) {
                attachPdf = 1;
            }

            $.post('{{ route('quoteMail.store') }}', {
                quote_id: {{ $quoteId }},
                to: $('#to').val(),
                cc: $('#cc').val(),
                bcc: $('#bcc').val(),
                subject: $('#subject').val(),
                body: $('#body').val(),
                attach_pdf: attachPdf
            }).done(function (response) {
                $('#modal-status-placeholder').html('<div class="alert alert-success">' + '{{ trans('fi.sent') }}' + '</div>');
                setTimeout('window.location=\'{{ $redirectTo }}\'', 1000);
            }).fail(function (response) {
                $btn.button('reset');
                if (response.status == 400) {
                    showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
                } else {
                    alert('{{ trans('fi.unknown_error') }}');
                }
            });
        });
    });

</script>
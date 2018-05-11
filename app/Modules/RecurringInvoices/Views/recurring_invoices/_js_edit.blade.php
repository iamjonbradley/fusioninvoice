<script type="text/javascript">

    $(function () {

        $("#next_date").datepicker({format: '{{ config('fi.datepickerFormat') }}', autoclose: true});
        $("#stop_date").datepicker({format: '{{ config('fi.datepickerFormat') }}', autoclose: true});
        $('textarea').autosize();

        $('#btn-copy-recurring-invoice').click(function () {
            $('#modal-placeholder').load('{{ route('recurringInvoiceCopy.create') }}', {
                recurring_invoice_id: {{ $recurringInvoice->id }}
            });
        });

        $('#btn-update-exchange-rate').click(function () {
            updateExchangeRate();
        });

        $('#currency_code').change(function () {
            updateExchangeRate();
        });

        function updateExchangeRate() {
            $.post('{{ route('currencies.getExchangeRate') }}', {
                currency_code: $('#currency_code').val()
            }, function (data) {
                $('#exchange_rate').val(data);
            });
        }

        $('.btn-delete-recurring-invoice-item').click(function () {
            if (!confirm('{!! trans('fi.delete_record_warning') !!}')) return false;
            var id = $(this).data('item-id');
            $.post('{{ route('recurringInvoiceItem.delete') }}', {
                id: id
            }).done(function () {
                $('#tr-item-' + id).remove();
                $('#div-totals').load('{{ route('recurringInvoiceEdit.refreshTotals') }}', {
                    id: {{ $recurringInvoice->id }}
                });
            });
        });

        $('.btn-save-recurring-invoice').click(function () {
            var items = [];
            var item_order = 1;
            var custom_fields = {};
            var apply_exchange_rate = $(this).data('apply-exchange-rate');

            $('table tr.item').each(function () {
                var row = {};
                $(this).find('input,select,textarea').each(function () {
                    if ($(this).is(':checkbox')) {
                        if ($(this).is(':checked')) {
                            row[$(this).attr('name')] = 1;
                        }
                        else {
                            row[$(this).attr('name')] = 0;
                        }
                    }
                    else {
                        row[$(this).attr('name')] = $(this).val();
                    }
                });
                row['item_order'] = item_order;
                item_order++;
                items.push(row);
            });

            $('.custom-form-field').each(function () {
                custom_fields[$(this).data('field-name')] = $(this).val();
            });

            $.post('{{ route('recurringInvoices.update', [$recurringInvoice->id]) }}', {
                items: JSON.stringify(items),
                terms: $('#terms').val(),
                footer: $('#footer').val(),
                currency_code: $('#currency_code').val(),
                exchange_rate: $('#exchange_rate').val(),
                custom: JSON.stringify(custom_fields),
                apply_exchange_rate: apply_exchange_rate,
                template: $('#template').val(),
                summary: $('#summary').val(),
                discount: $('#discount').val(),
                next_date: $('#next_date').val(),
                stop_date: $('#stop_date').val(),
                recurring_frequency: $('#recurring_frequency').val(),
                recurring_period: $('#recurring_period').val()
            }).done(function () {
                $('#div-recurring-invoice-edit').load('{{ route('recurringInvoiceEdit.refreshEdit', [$recurringInvoice->id]) }}', function () {
                    notify('{{ trans('fi.record_successfully_updated') }}', 'success');
                });
            }).fail(function (response) {
                if (response.status == 400) {
                    $.each($.parseJSON(response.responseText).errors, function (id, message) {
                        notify(message, 'danger');
                    });
                } else {
                    notify('{{ trans('fi.unknown_error') }}', 'danger');
                }
            });
        });

        var fixHelper = function (e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function (index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };

        $("#item-table tbody").sortable({
            helper: fixHelper
        });

    });

</script>
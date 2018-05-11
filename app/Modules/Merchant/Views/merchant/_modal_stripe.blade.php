<script type="text/javascript">

    Stripe.setPublishableKey('{{ $merchant['Stripe']['publishableKey'] }}');

    var stripeResponseHandler = function (status, response) {
        var $form = $('#payment-form');
        if (response.error) {
            showErrors({message: [response.error.message]}, '#modal-status-placeholder');
            $form.find('input[type="submit"]').prop('disabled', false);
        } else {
            var token = response.id;
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            $form.get(0).submit();
        }
    };

    $(function () {
        $('#modal-cc-payment').modal('show');

        $('#payment-form').submit(function (e) {
            $.post("{{ route('merchant.invoice.validate') }}", {
                merchant: 'Stripe',
                name: $('#name').val(),
                address_line1: $('#address_line1').val(),
                address_city: $('#address_city').val(),
                address_state: $('#address_state').val(),
                address_zip: $('#address_zip').val()
            }).done(function () {
                var $form = $('#payment-form');
                $form.find('input[type="submit"]').prop('disabled', true);
                Stripe.card.createToken($form, 100, stripeResponseHandler);
            }).fail(function (response) {
                console.log($.parseJSON(response.responseText).errors);
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            });
            return false;
        });
    });
</script>

<div class="modal fade" id="modal-cc-payment">
    {!! Form::open(['route' => ['merchant.invoice.payCc', $invoice->url_key, 'merchant' => 'Stripe'], 'class' => 'form-horizontal', 'id' => 'payment-form']) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ trans('fi.pay_now') }} ({{ $invoice->amount->formatted_balance }})</h4>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                @if (in_array(config('fi.merchant.Stripe.requireBillingName'), [1, 2]))
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.billing_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" class="form-control" data-stripe="name">
                        </div>
                    </div>
                @endif

                @if (in_array(config('fi.merchant.Stripe.requireBillingAddress'), [1, 2]))
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.billing_address') }}</label>
                        <div class="col-sm-9">
                            <input type="text" id="address_line1" class="form-control" data-stripe="address_line1">
                        </div>
                    </div>
                @endif

                @if (in_array(config('fi.merchant.Stripe.requireBillingCity'), [1, 2]))
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.billing_city') }}</label>
                        <div class="col-sm-9">
                            <input type="text" id="address_city" class="form-control" data-stripe="address_city">
                        </div>
                    </div>
                @endif

                @if (in_array(config('fi.merchant.Stripe.requireBillingState'), [1, 2]))
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.billing_state') }}</label>
                        <div class="col-sm-9">
                            <input type="text" id="address_state" class="form-control" data-stripe="address_state">
                        </div>
                    </div>
                @endif

                @if (in_array(config('fi.merchant.Stripe.requireBillingZip'), [1, 2]))
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.billing_zip') }}</label>
                        <div class="col-sm-9">
                            <input type="text" id="address_zip" class="form-control" data-stripe="address_zip">
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ trans('fi.card_number') }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" data-stripe="number">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ trans('fi.cvc') }}</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" data-stripe="cvc" placeholder="CVC">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ trans('fi.expiration') }} (MM/YYYY)</label>
                    <div class="col-sm-2" style="padding-right: 5px;">
                        <input type="text" class="form-control" data-stripe="exp-month" placeholder="MM">
                    </div>
                    <div class="col-sm-3" style="padding-left: 5px;">
                        <input type="text" class="form-control" data-stripe="exp-year" placeholder="YYYY">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                <input type="submit" id="invoice-pay-confirm" class="btn btn-primary"
                       value="{{ trans('fi.pay_now') }} ({{ $invoice->amount->formatted_balance }})">
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
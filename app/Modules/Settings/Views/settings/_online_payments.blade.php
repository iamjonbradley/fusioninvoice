<h4 style="font-weight: bold; clear: both;">PayPal</h4>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.enabled') }}: </label>
            {!! Form::select('setting[merchant][PayPalExpress][enabled]', [0=>trans('fi.no'),1=>trans('fi.yes')], $merchant['PayPalExpress']['enabled'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.test_mode') }}: </label>
            {!! Form::select('setting[merchant][PayPalExpress][testMode]', [0=>trans('fi.no'),1=>trans('fi.yes')], $merchant['PayPalExpress']['testMode'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.merchant_api_username') }}: </label>
            {!! Form::text('setting[merchant][PayPalExpress][username]', $merchant['PayPalExpress']['username'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.merchant_api_password') }}: </label>
            {!! Form::text('setting[merchant][PayPalExpress][password]', $merchant['PayPalExpress']['password'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.merchant_signature') }}: </label>
            {!! Form::text('setting[merchant][PayPalExpress][signature]', $merchant['PayPalExpress']['signature'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ trans('fi.payment_button_text') }}: </label>
            {!! Form::text('setting[merchant][PayPalExpress][paymentButtonText]', $merchant['PayPalExpress']['paymentButtonText'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<hr>

<h4 style="font-weight: bold; clear: both;">Stripe</h4>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.enabled') }}: </label>
            {!! Form::select('setting[merchant][Stripe][enabled]', [0=>trans('fi.no'),1=>trans('fi.yes')], $merchant['Stripe']['enabled'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.merchant_secret_key') }}: </label>
            {!! Form::text('setting[merchant][Stripe][secretKey]', $merchant['Stripe']['secretKey'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.merchant_publishable_key') }}: </label>
            {!! Form::text('setting[merchant][Stripe][publishableKey]', $merchant['Stripe']['publishableKey'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>{{ trans('fi.billing_name') }}: </label>
                    {!! Form::select('setting[merchant][Stripe][requireBillingName]', $merchantCcOptions, $merchant['Stripe']['requireBillingName'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>{{ trans('fi.billing_address') }}: </label>
                    {!! Form::select('setting[merchant][Stripe][requireBillingAddress]', $merchantCcOptions, $merchant['Stripe']['requireBillingAddress'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>{{ trans('fi.billing_city') }}: </label>
                    {!! Form::select('setting[merchant][Stripe][requireBillingCity]', $merchantCcOptions, $merchant['Stripe']['requireBillingCity'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>{{ trans('fi.billing_state') }}: </label>
                    {!! Form::select('setting[merchant][Stripe][requireBillingState]', $merchantCcOptions, $merchant['Stripe']['requireBillingState'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>{{ trans('fi.billing_zip') }}: </label>
                    {!! Form::select('setting[merchant][Stripe][requireBillingZip]', $merchantCcOptions, $merchant['Stripe']['requireBillingZip'], ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ trans('fi.payment_button_text') }}: </label>
            {!! Form::text('setting[merchant][Stripe][paymentButtonText]', $merchant['Stripe']['paymentButtonText'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<hr>

<h4 style="font-weight: bold; clear: both;">Mollie</h4>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.enabled') }}: </label>
            {!! Form::select('setting[merchant][Mollie][enabled]', [0=>trans('fi.no'),1=>trans('fi.yes')], $merchant['Mollie']['enabled'], ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ trans('fi.merchant_api_key') }}: </label>
            {!! Form::text('setting[merchant][Mollie][apiKey]', $merchant['Mollie']['apiKey'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ trans('fi.payment_button_text') }}: </label>
            {!! Form::text('setting[merchant][Mollie][paymentButtonText]', $merchant['Mollie']['paymentButtonText'], ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
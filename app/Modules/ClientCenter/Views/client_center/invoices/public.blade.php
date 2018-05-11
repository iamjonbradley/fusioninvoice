@extends('client_center.layouts.public')

@section('javascript')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function () {
            $('#view-notes').hide();
            $('.btn-notes').click(function () {
                $('#view-doc').toggle();
                $('#view-notes').toggle();
                $('#' + $(this).data('button-toggle')).show();
                $(this).hide();
            });

            @if ($invoice->isPayable)
            $('#btn-direct-payment').click(function () {
                $('#modal-placeholder').load("{{ route('merchant.invoice.modalCc', [$invoice->url_key]) }}", {
                    urlKey: $(this).data('url-key'),
                    merchant: $(this).data('merchant')
                });
            });
            @endif
        });
    </script>
@stop

@section('content')

    <section class="content">

        <div class="public-wrapper">

            @include('layouts._alerts')

            <div style="margin-bottom: 15px;">

                <a href="{{ route('clientCenter.public.invoice.pdf', [$invoice->url_key]) }}" target="_blank"
                   class="btn btn-primary"><i class="fa fa-print"></i> <span>{{ trans('fi.pdf') }}</span>
                </a>

                @if (auth()->check())
                    <a href="javascript:void(0)" id="btn-notes" data-button-toggle="btn-notes-back" class="btn btn-primary btn-notes">
                        <i class="fa fa-comments"></i> {{ trans('fi.notes') }}
                    </a>
                    <a href="javascript:void(0)" id="btn-notes-back" data-button-toggle="btn-notes" class="btn btn-primary btn-notes" style="display: none;">
                        <i class="fa fa-backward"></i> {{ trans('fi.back_to_invoice') }}
                    </a>
                @endif

                @if (count($attachments))
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-files-o"></i> {{ trans('fi.attachments') }} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($attachments as $attachment)
                                <li><a href="{{ $attachment->download_url }}">{{ $attachment->filename }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($invoice->isPayable)
                    @foreach ($merchants as $key => $merchant)
                        @if ($merchant['enabled'])
                            @if ($merchant['isRedirect'])
                                <a href="{{ route('merchant.invoice.pay', [$invoice->url_key, 'merchant' => $key]) }}"
                                   class="btn btn-primary"><i class="fa fa-credit-card"></i>
                                    <span>{{ $merchant['paymentButtonText'] }}</span></a>
                            @else
                                <a href="javascript:void(0)" id="btn-direct-payment"
                                   data-url-key="{{ $invoice->url_key }}" data-merchant="{{ $key }}" class="btn btn-primary">
                                    <i class="fa fa-credit-card"></i>
                                    <span>{{ $merchant['paymentButtonText'] }}</span></a>
                            @endif
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="public-doc-wrapper">

                <div id="view-doc">
                    <iframe src="{{ route('clientCenter.public.invoice.html', [$urlKey]) }}" frameborder="0"
                            style="width: 100%;" scrolling="no" onload="resizeIframe(this, 800);"></iframe>
                </div>

                @if (auth()->check())
                    <div id="view-notes">
                        @include('notes._notes', ['object' => $invoice, 'model' => 'FI\Modules\Invoices\Models\Invoice'])
                    </div>
                @endif

            </div>

        </div>

    </section>

@stop
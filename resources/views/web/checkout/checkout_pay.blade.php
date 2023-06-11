@extends('layouts.guest')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>/
                    <li class='active'>Thanh toán</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row checkout-form">
                <div class="col-md-12 ">
                    <h1>Thanh toán qua thẻ quốc tế</h1>
                    <div class="col-md-6">
                        <div>
                            <form action="{{ route('checkout.store.pay') }}" method="post" id="payment-form">
                                @csrf
                                <input type="hidden" name="payment_method" id="payment-method" value="">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="form-group">
                                    <label for="card-element">Thẻ tín dụng hoặc thẻ ghi nợ</label>
                                    <div id="card-element" class="card-element"></div>
                                    <div id="card-errors" class="text-danger"></div>
                                </div>
                                <button type="button" id="payment-button" class="btn btn-primary">Thanh toán</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.publishable_key') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var cardErrors = document.getElementById('card-errors');
        cardElement.addEventListener('change', function(event) {
            if (event.error) {
                cardErrors.textContent = event.error.message;
            } else {
                cardErrors.textContent = '';
            }
        });

        $('#payment-button').on('click', function() {
            $('#payment-button').attr('disabled', true);

            stripe
                .confirmCardSetup('{{ $paymentIntent->client_secret }}', {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: "{{ auth()->user()->name }}",
                        },
                    },
                })
                .then(function(result) {
                    // Handle result.error or result.setupIntent
                    if (!result.error) {
                        //get value payment_method
                        $('#payment-method').val(result.setupIntent.payment_method);
                        $('#payment-form').submit();
                    }
                });
        });
    </script>
@endpush

@extends('payments::layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @if (Session::has('message'))
                    <div class="alert alert-{{ Session::get('code') }}">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                @endif



                    <div class="panel panel-default">
                        <div class="panel-heading">PayPal Pro</div>
                        <div class="panel-body">
                            Switch to Paypal Pro
                            <a href="{{route('paypal.pro.payment')}}" class="btn btn-primary">
                                Pro Payment
                            </a>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">PayPal Pro</div>
                        <div class="panel-body">
                            <div id="paypal-button"></div>
                        </div>
                    </div>

            </div>
        </div>
    </div>



    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script>
        paypal.Button.render({

            env: 'sandbox', // Or 'sandbox'

            client: {
                sandbox:    '{{env('PAYPAL_SANDBOX_API_EXP_CLIENT_ID', '')}}',
                production: '{{env('PAYPAL_PRODUCTION_API_EXP_CLIENT_ID','')}}'
            },

            commit: true, // Show a 'Pay Now' button

            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '1.00', currency: 'USD' }
                            }
                        ]
                    }
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function(payment) {

                    // The payment is complete!
                    // You can now show a confirmation message to the customer
                });
            }

        }, '#paypal-button');
    </script>

@endsection
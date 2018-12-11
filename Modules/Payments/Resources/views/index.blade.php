@extends('payments::layouts.master')

@section('content')

   <div class="row" style="padding-top: 20px">
       <div class="col-md-8 col-md-offset-2">
           <a href="{{route('payments.settings')}}" class="btn btn-primary">Settings</a>
           <div class="panel panel-default">
               <div class="panel-heading">Choose Payment Methods</div>
               <div class="panel-body">
                   <ul>
                       @if($methods['paypal_pro'][0]['status'] == 1)
                       <li>
                           Switch to Paypal Pro
                           <a href="{{route('paypal.pro.payment')}}" class="btn btn-primary">
                               Pro Payment
                           </a>
                       </li>
                       @endif
                           @if($methods['paypal'][0]['status'] == 1)
                       <li>

                           <div id="paypal-button"></div>
                       </li>
                           @endif
                       @if($methods['google wallet'][0]['status'] == 1)
                       <li>
                           <div id="container"></div>
                       </li>
                           @endif
                           @if($methods['authorize'][0]['status'] == 1)
                               <li>
                                   <a href="{{route('authorize.net.index')}}" class="btn btn-primary">
                                       Authorize
                                   </a>
                               </li>
                           @endif
                           @if($methods['sofort'][0]['status'] == 1)
                               <li>
                                   <a href="{{route('sofort.payment.process')}}" class="btn btn-primary">
                                       Sofort Bank Transaction
                                   </a>
                               </li>
                           @endif

                   </ul>
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

   <script>
       /**
        * Payment methods accepted by your gateway
        *
        * @todo confirm support for both payment methods with your gateway
        */
       var allowedPaymentMethods = ['CARD', 'TOKENIZED_CARD'];

       /**
        * Card networks supported by your site and your gateway
        *
        * @see {@link https://developers.google.com/pay/api/web/reference/object#CardRequirements|CardRequirements}
        * @todo confirm card networks supported by your site and gateway
        */
       var allowedCardNetworks = ['AMEX', 'DISCOVER', 'JCB', 'MASTERCARD', 'VISA'];

       /**
        * Identify your gateway and your site's gateway merchant identifier
        *
        * The Google Pay API response will return an encrypted payment method capable of
        * being charged by a supported gateway after shopper authorization
        *
        * @todo check with your gateway on the parameters to pass
        * @see {@link https://developers.google.com/pay/api/web/reference/object#Gateway|PaymentMethodTokenizationParameters}
        */
       var tokenizationParameters = {
           tokenizationType: 'PAYMENT_GATEWAY',
           parameters: {
               'gateway': '{{env('GOOGLE_WALLET_GATEWAY','example')}}',
               'gatewayMerchantId': '{{env('GOOGLE_WALLET_GATEWAY_MERCHANT_ID','abc123')}}'
           }
       }

       /**
        * Initialize a Google Pay API client
        *
        * @returns {google.payments.api.PaymentsClient} Google Pay API client
        */
       function getGooglePaymentsClient() {
           return (new google.payments.api.PaymentsClient({environment: 'TEST'}));
       }

       /**
        * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
        */
       function onGooglePayLoaded() {
           var paymentsClient = getGooglePaymentsClient();
           paymentsClient.isReadyToPay({allowedPaymentMethods: allowedPaymentMethods})
               .then(function(response) {
                   if (response.result) {
                       addGooglePayButton();
                       prefetchGooglePaymentData();
                   }
               })
               .catch(function(err) {
                   // show error in developer console for debugging
                   console.error(err);
               });
       }

       /**
        * Add a Google Pay purchase button alongside an existing checkout button
        *
        * @see {@link https://developers.google.com/pay/api/web/reference/object#ButtonOptions|Button options}
        * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
        */
       function addGooglePayButton() {
           var paymentsClient = getGooglePaymentsClient();
           var button = paymentsClient.createButton({onClick:onGooglePaymentButtonClicked});
           document.getElementById('container').appendChild(button);
       }

       /**
        * Configure support for the Google Pay API
        *
        * @see {@link https://developers.google.com/pay/api/web/reference/object#PaymentDataRequest|PaymentDataRequest}
        * @returns {object} PaymentDataRequest fields
        */
       function getGooglePaymentDataConfiguration() {
           return {
               // @todo a merchant ID is available for a production environment after approval by Google
               // @see {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
               merchantId: '01234567890123456789',
               paymentMethodTokenizationParameters: tokenizationParameters,
               allowedPaymentMethods: allowedPaymentMethods,
               cardRequirements: {
                   allowedCardNetworks: allowedCardNetworks
               }
           };
       }

       /**
        * Provide Google Pay API with a payment amount, currency, and amount status
        *
        * @see {@link https://developers.google.com/pay/api/web/reference/object#TransactionInfo|TransactionInfo}
        * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
        */
       function getGoogleTransactionInfo() {
           return {
               currencyCode: 'USD',
               totalPriceStatus: 'FINAL',
               // set to cart total
               totalPrice: '1.00'
           };
       }

       /**
        * Prefetch payment data to improve performance
        */
       function prefetchGooglePaymentData() {
           var paymentDataRequest = getGooglePaymentDataConfiguration();
           // transactionInfo must be set but does not affect cache
           paymentDataRequest.transactionInfo = {
               totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
               currencyCode: 'USD'
           };
           var paymentsClient = getGooglePaymentsClient();
           paymentsClient.prefetchPaymentData(paymentDataRequest);
       }

       /**
        * Show Google Pay chooser when Google Pay purchase button is clicked
        */
       function onGooglePaymentButtonClicked() {
           var paymentDataRequest = getGooglePaymentDataConfiguration();
           paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

           var paymentsClient = getGooglePaymentsClient();
           paymentsClient.loadPaymentData(paymentDataRequest)
               .then(function(paymentData) {
                   // handle the response
                   processPayment(paymentData);
               })
               .catch(function(err) {
                   // show error in developer console for debugging
                   console.error(err);
               });
       }

       /**
        * Process payment data returned by the Google Pay API
        *
        * @param {object} paymentData response from Google Pay API after shopper approves payment
        * @see {@link https://developers.google.com/pay/api/web/reference/object#PaymentData|PaymentData object reference}
        */
       function processPayment(paymentData) {
           // show returned data in developer console for debugging
           console.log(paymentData);
           // @todo pass payment data response to gateway to process payment
       }
   </script>
   <script async
           src="https://pay.google.com/gp/p/js/pay.js"
           onload="onGooglePayLoaded()"></script>




@endsection
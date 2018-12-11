@extends('payments::layouts.master')

@section('content')

<div class="row" style="padding-top: 20px">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Enter Details</div>
            <div class="panel-body">


                <form action="{{route('authorize.net.process')}}" method="POST">
                    @csrf()
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="street">Street</label>
                                <input type="text" name="street" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="currency_code">Currency Code</label>
                                <input type="text" name="currency_code" disabled value="US" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="country_code">Country Code</label>
                                <input type="text" name="country_code" class="form-control" placeholder="US" required>
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" name="state" class="form-control" required placeholder="FL">
                            </div>
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" name="zip" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h3 style="text-align: center">Card Details</h3>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="card_no">Card Number</label>
                                <input type="text" id="card_input" name="card_no" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="expiry">Expiry</label>
                                <input type="text" name="exp" class="form-control" required placeholder="MMYYYY">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" name="cvv" class="form-control" required placeholder="123">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="card_type">Card Type</label>
                                <input type="text" name="card_type" class="form-control" placeholder="VISA" required>
                            </div>
                        </div>
                    </div>
                    <p class="log"></p>

                    <div class="row" style="padding: 0 20px 0 20px">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




@endsection
@extends('adminTheme.default')
@section('title', 'Dashboard')

@section('style')

@endsection

@section('content-header')
    <h1>@lang('admin.general.welcome-dashboard')</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
            </a>
        </li>
    </ol>
@endsection
@section('content')
    <div class="container" style="padding-right: 150px;">
        <div class="row" style="margin-top: 20px">
            <h1 style="text-align: center">@lang('admin.user.register-user')</h1>
            <form action="{{route('save.basic.info')}}" method="POST">
                @csrf()

                <input type="hidden" value="individual" name="type">

                @include('user::partials.basic_form')

                <div class="row">
                    <div class="col-md-6">
                        <h3>@lang('admin.user.billing-address')/h3>
                            <input type="checkbox" id="billing_check_box" onchange="show_hide()" checked name="billing"> <label for="">@lang('admin.user.save-as-above')</label>
                    </div>
                </div>

                <div id="bill_info" style="display: none;">
                    @include('user::partials.billing_form')
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="security_question">@lang('admin.user.security_question')</label>
                            <select name="security_question" id="security_question" class="form-control">
                                @foreach($questions as $question)
                                    <option value="{{$question->id}}">{{$question->question}}</option>
                                @endforeach
                            </select>
                            <label for="answer">@lang('admin.user.answer')</label>
                            <input type="text" name="answer" required class="form-control" placeholder="Answer">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-block" type="submit">@lang('admin.user.next')</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>


        function show_hide(){
            var x = document.getElementById("bill_info");
            if (x.style.display === "none") {
                // alert('show');
                x.style.display = "block";
                document.getElementById('billing_first_name').type = "text";
                document.getElementById('billing_last_name').type = "text";
                document.getElementById('billing_email').type = "email";
                document.getElementById('billing_postal_code').type = "text";
                document.getElementById('billing_phone').type = "text";
                document.getElementById('billing_address').type = "text";
            } else {
                x.style.display = "none";
                document.getElementById('billing_first_name').type = "hidden";
                document.getElementById('billing_last_name').type = "hidden";
                document.getElementById('billing_email').type = "hidden";
                document.getElementById('billing_postal_code').type = "hidden";
                document.getElementById('billing_phone').type = "hidden";
                document.getElementById('billing_address').type = "hidden";

            }
        }


        $(document).ready(function(){
            var states = [];
            var cities = [];
                    @if($states)
                    @foreach($states as $state)
            var item = {};
            item.country_id = '{{$state->country_id}}';
            item.id = '{{$state->id}}';
            item.name = '{{$state->name}}';
            states.push(item);
                    @endforeach
                    @endif
                    @if($cities)
                    @foreach($cities as $city)
            var item = {};
            item.state_id = '{{$city->state_id}}';
            item.id = '{{$city->id}}';
            item.name = '{{$city->name}}';
            cities.push(item);
            @endforeach
            @endif

            jQuery(document).on('change', '#countryid', function(){
                var countryid = jQuery(this).find('option:selected').val();
                jQuery('#stateid').html('<option value="">Select State</option>');
                jQuery('#cityid').html('<option value="">Select City</option>');
                if(countryid) {
                    jQuery.each(states, function (i, item) {
                        if (item.country_id == countryid) {
                            jQuery('#stateid').append('<option value="' + item.id + '">' + item.name + '</option>');
                        }
                    });
                }
            });
            jQuery(document).on('change', '#stateid', function(){
                var stateid = jQuery(this).find('option:selected').val();
                jQuery('#cityid').html('<option value="">Select City</option>');
                if(stateid) {
                    jQuery.each(cities, function (i, item) {
                        if (item.state_id == stateid) {
                            jQuery('#cityid').append('<option value="' + item.id + '">' + item.name + '</option>');
                        }
                    });
                }
            });
        });


    </script>
@endsection
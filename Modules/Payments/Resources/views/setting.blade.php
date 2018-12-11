@extends('payments::layouts.master')

@section('content')

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <h1 style="padding-top: 20px; text-align: center">Settings</h1>

    <div class="row" style="padding-top: 20px">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{url('/payments')}}" class="btn btn-primary">Back</a> Change payment settings</div>
                <div class="panel-body">
                    @foreach($methods as $method)
                        <div class="row">
                            <div class="col-md-3">
                                <h3>{{$method->method_name}}</h3>
                            </div>
                            <div class="col-md-3">
                                <label for="amount">Amount</label>
                                <input value="{{$method->amount}}" type="text" class="form-control"
                                       placeholder="amount" id="amount{{$loop->index}}"
                                       onblur="amount('{{$method->id}}','amount{{$loop->index}}')">
                            </div>
                            <div class="col-md-3">
                                <label for="percent">%</label>
                                <input value="{{$method->percent}}" type="text" id="percent{{$loop->index}}" class="form-control"
                                       placeholder="%"
                                       onblur="percent('{{$method->id}}','percent{{$loop->index}}')">
                            </div>
                            <div class="col-md-3" style="display: flex;flex-direction: column">
                                <label for="active">Status</label>
                                <label class="switch">
                                    <input @if($method->status==1)checked @endif type="checkbox" onchange="change_status(this,'{{$method->id}}')">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                        </div>
                        <hr>
                    @endforeach

                </div>
            </div>

        </div>
    </div>



    <script>

        function amount(method_id,input_id) {

           var amount =$('#'+input_id).val();
            if (amount == "") {
                amount=0;
            }

            $.get("{{url('payments/method/amount')}}",
                {
                    method_id: method_id,
                    amount: amount
                },
                function(data, status){
                console.log(data);
                    // alert("Data: " + data['method_id'] + "\nStatus: " + status);
                });

        }

        function percent(method_id,input_id) {

            var amount =$('#'+input_id).val();
            if (amount == "") {
                amount=0;
            }

            $.get("{{url('payments/method/percent')}}",
                {
                    method_id: method_id,
                    percent: amount
                },
                function(data, status){
                    console.log(data);
                    // alert("Data: " + data['method_id'] + "\nStatus: " + status);
                });

        }

        function change_status(obj,method_id) {
            if($(obj).is(":checked")){
              var status = 1;
            }else{
                var status = 0;
            }

            $.get("{{url('payments/method/changeStatus')}}",
                {
                    method_id: method_id,
                    status: status
                },
                function(data, status){
                    console.log(data);
                    // alert("Data: " + data['method_id'] + "\nStatus: " + status);
                });

        }
    </script>

@endsection
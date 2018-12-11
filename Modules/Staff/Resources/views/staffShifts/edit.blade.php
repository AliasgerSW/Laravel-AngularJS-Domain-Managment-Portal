@extends('adminTheme.default')

@section('title', 'Edit Staff Shifts')

@section('content-header')
    <h1>Manage Staff Shifts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#"> Staff</a>
        </li>
        <li>
            <a href="{{ route('staffShifts.index') }}"> Staff Shifts</a>
        </li>
        <li class="active"> Edit Staff Shift</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Update Staff Shift
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ route('staffShifts.update', $staffShift->id)  }}" class="form-horizontal" method="POST">
                        @csrf
                        @method('PUT')
                        @include('staff::staffShifts.fields')
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('adminTheme/vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

    <script>
        $(".click24hours").datetimepicker({
            format: 'HH:mm:ss'
        }).parent().css("position :relative");
    </script>
@stop

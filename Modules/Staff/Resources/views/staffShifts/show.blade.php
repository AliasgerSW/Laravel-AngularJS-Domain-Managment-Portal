@extends('adminTheme.default')

@section('title', 'Create Staff Shifts')

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
        <li class="active"> Show Staff Shift </li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Show Staff Shift
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- shift_name Field -->
                        <div class="form-group col-sm-12">
                            <strong >Shift Name:</strong>
                            <p>{{ $staffShift->shift_name }}</p>
                        </div>

                        <!-- shift_descr Field -->
                        <div class="form-group col-sm-12">
                            <strong >Shift Descr:</strong>
                            <p>{{ $staffShift->shift_descr }}</p>
                        </div>

                        <!-- start_from Field -->
                        <div class="form-group col-sm-12">
                            <strong >Start From:</strong>
                            <p>{{ $staffShift->start_from }}</p>
                        </div>

                        <!-- ends_at Field -->
                        <div class="form-group col-sm-12">
                            <strong >Ends at:</strong>
                            <p>{{ $staffShift->ends_at }}</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

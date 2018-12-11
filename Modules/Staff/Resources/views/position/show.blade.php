@extends('adminTheme.default')

@section('title', 'Create ' . __('admin.staffPosition.title'))

@section('content-header')
    <h1>@lang('admin.staffPosition.title')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="{{ route('staffs.index') }}"> @lang('admin.staff.title')</a>
        </li>
        <li class="active"> Show @lang('admin.staffPosition.title')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="diagram" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.show') @lang('admin.staffPosition.title')
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.staffPosition.name'):</strong>
                            <p>{{ $position->position_name }}</p>
                        </div>

                        <!-- Enter Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.staffPosition.code'):</strong>
                            <p>{{ $position->position_code }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

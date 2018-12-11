@extends('adminTheme.default')

@section('title',  __('admin.general.show').' '.__('admin.geo.state'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.state')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="#"> @lang('admin.geo')</a>
        </li>
        <li>
            <a href="{{ route('countries.index') }}"> @lang('admin.geo.state')</a>
        </li>
        <li class="active"> @lang('admin.general.show') @lang('admin.geo.state')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.show') @lang('admin.geo.state')
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- Country Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.state.country'):</strong>
                            <p>{{ $state->country->name }}</p>
                        </div>

                        <!-- Name -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.state.name'):</strong>
                            <p>{{ $state->name }}</p>
                        </div>

                        <!-- Enter Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.state.code'):</strong>
                            <p>{{ $state->code  }}</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

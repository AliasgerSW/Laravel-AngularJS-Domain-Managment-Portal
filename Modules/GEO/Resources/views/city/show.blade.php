@extends('adminTheme.default')

@section('title',  __('admin.general.show').' '.__('admin.geo.city'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.city')</h1>
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
            <a href="{{ route('cities.index') }}"> @lang('admin.geo.city')</a>
        </li>
        <li class="active"> @lang('admin.general.show') @lang('admin.geo.city')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.show') @lang('admin.geo.city')
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <!-- Enter Country Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.city.country'):</strong>
                            <p>{{ $city->country->name  }}</p>
                        </div>

                        <!-- Enter State Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.city.state'):</strong>
                            <p>{{ $city->state->name  }}</p>
                        </div>

                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.city.name'):</strong>
                            <p>{{ $city->name }}</p>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@extends('adminTheme.default')

@section('title',  __('admin.general.show').' '.__('admin.geo.postcode'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.postcode')</h1>
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
            <a href="{{ route('post-code.index') }}"> @lang('admin.geo.postcode')</a>
        </li>
        <li class="active"> @lang('admin.general.show') @lang('admin.geo.postcode')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Show Post Code
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- City Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.postcode.city'):</strong>
                            <p>{{ $postCode->city->name }}</p>
                        </div>

                        <!-- Enter Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.postcode.code'):</strong>
                            <p>{{ $postCode->code  }}</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

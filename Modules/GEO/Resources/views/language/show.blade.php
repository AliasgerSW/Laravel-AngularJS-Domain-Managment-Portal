@extends('adminTheme.default')

@section('title', __('admin.general.show') .' '.__('admin.geo.language'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.language')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="#">  @lang('admin.geo')</a>
        </li>
        <li>
            <a href="{{ route('languages.index') }}"> @lang('admin.geo.language')</a>
        </li>
        <li class="active"> @lang('admin.general.show') @lang('admin.geo.language')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.show') @lang('admin.geo.language')
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.language.nameenglish'):</strong>
                            <p>{{ $language->name_english }}</p>
                        </div>

                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.language.name'):</strong>
                            <p>{{ $language->name }}</p>
                        </div>

                        <!-- Enter Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.language.code'):</strong>
                            <p>{{ $language->code  }}</p>
                        </div>

                        <!-- script_type Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.language.scripttype'):</strong>
                            <p>{{ $language->script_type }}</p>
                        </div>

                        <!-- family Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.language.family'):</strong>
                            <p>{{ $language->family }}</p>
                        </div>

                        <!-- Language Type Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.language.type'):</strong>
                            <p>{{ $language->type }}</p>
                        </div>

                        <!-- Language Type ISO Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.language.typeIsoCode'):</strong>
                            <p>{{ $language->type_iso_code }}</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

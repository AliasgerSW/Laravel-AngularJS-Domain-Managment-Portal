@extends('adminTheme.default')

@section('title',  __('admin.general.show').' '.__('admin.geo.country'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.country')</h1>
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
            <a href="{{ route('countries.index') }}"> @lang('admin.geo.country')</a>
        </li>
        <li class="active"> @lang('admin.general.show') @lang('admin.geo.country')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.show') @lang('admin.geo.country')
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.geo.country.name'):</strong>
                            <p>{{ $country->name }}</p>
                        </div>

                        <!-- Enter ISO Alpha Code 2 Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.country.IsoAlphaCode2'):</strong>
                            <p>{{ $country->iso_alpha_2_code  }}</p>
                        </div>

                        <!-- Enter ISO Alpha Code 3 Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.country.IsoAlphaCode3'):</strong>
                            <p>{{ $country->iso_alpha_3_code  }}</p>
                        </div>

                        <!-- Enter ISO Numeric Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.country.IsoNumericCode'):</strong>
                            <p>{{ $country->iso_numeric_code  }}</p>
                        </div>

                        <!-- Enter Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.country.code'):</strong>
                            <p>{{ $country->code  }}</p>
                        </div>

                        <!-- Enter TLD Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.country.Tld'):</strong>
                            <p>{{ $country->tld  }}</p>
                        </div>

                        <!-- Enter Languge Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.geo.country.language'):</strong>
                            <p>
                            @if($country->language->count() > 0)
                                @foreach($country->language as $language)
                                    {{ $language->name }},
                                @endforeach
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

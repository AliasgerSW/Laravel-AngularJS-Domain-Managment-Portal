@extends('adminTheme.default')

@section('title',  __('admin.general.edit').' '.__('admin.geo.country'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.country')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="#">   @lang('admin.geo')</a>
        </li>
        <li>
            <a href="{{ route('countries.index') }}"> @lang('admin.geo.country')</a>
        </li>
        <li class="active"> @lang('admin.general.edit') @lang('admin.geo.country')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.edit') @lang('admin.geo.country')
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ route('countries.update', $country->id)  }}" class="form-horizontal" method="POST">
                        @csrf
                        @method('PUT')
                        @include('geo::country.fields')
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

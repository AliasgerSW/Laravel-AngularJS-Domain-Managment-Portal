@extends('adminTheme.default')

@section('title', __('admin.general.create').' '.__('admin.geo.translation'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.translation')</h1>
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
            <a href="{{ route('translations.index') }}"> @lang('admin.geo.translation')</a>
        </li>
        <li class="active"> @lang('admin.general.create') @lang('admin.geo.translation')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.create') @lang('admin.geo.translation')
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ route('translations.store')  }}" class="form-horizontal" method="POST">
                        @csrf
                        @include('geo::translation.fields')
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

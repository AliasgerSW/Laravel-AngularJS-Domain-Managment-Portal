@extends('adminTheme.default')

@section('title', __('admin.general.edit') .' '. __('admin.geo.language'))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/bootstrap-switch/css/bootstrap-switch.css') }}">
    <style>
        .input-group{
            display: table-row;
        }
    </style>
@endsection


@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.geo.language')</h1>
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
            <a href="{{ route('languages.index') }}"> @lang('admin.geo.language')</a>
        </li>
        <li class="active"> @lang('admin.general.edit') @lang('admin.geo.language')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.edit') @lang('admin.geo.language')
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ route('languages.update', $language->id)  }}" class="form-horizontal" method="POST">
                        @csrf
                        @method('PUT')
                        @include('geo::language.fields')
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="{{ asset('adminTheme/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script>
        $("input[name='code']").keyup(function(){
            $(".like-json").text($(this).val() + '.json');
        });
        $("[name='is_translate']").bootstrapSwitch();
    </script>
@endsection
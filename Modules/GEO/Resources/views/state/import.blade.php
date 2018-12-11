@extends('adminTheme.default')

@section('title',  __('admin.general.import').' '.__('admin.geo.state'))

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
            <a href="{{ route('states.index') }}"> @lang('admin.geo.state')</a>
        </li>
        <li class="active"> @lang('admin.general.import') @lang('admin.geo.state')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.import') @lang('admin.geo.state')
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ route('states.import.post')  }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <fieldset>
                            <!-- Enter TLD Field -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="file">@lang('admin.general.uploadFile'):</label>
                                <div class="col-md-8">
                                    <input type="file" id="file" name="file" class="form-control" >
                                    <p class="text-warning">You can download sample file of csv from here: <a href="/Modules/GEO/Demo/country_import_test.csv">state_import_test.csv</a></p>
                                </div>
                            </div>

                            <!-- Submit Field -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> @lang('admin.general.save')</button>
                                <a href="{!! route('states.index') !!}" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> @lang('admin.general.cancel')</a>
                            </div>
                        </fieldset>

                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

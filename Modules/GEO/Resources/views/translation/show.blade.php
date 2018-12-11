@extends('adminTheme.default')

@section('title', 'Create Language')

@section('content-header')
    <h1>Manage Language</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#"> GEO</a>
        </li>
        <li>
            <a href="{{ route('languages.index') }}"> Language</a>
        </li>
        <li class="active"> Show Language</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Show Language
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >Name(English):</strong>
                            <p>{{ $language->name_english }}</p>
                        </div>

                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >Name:</strong>
                            <p>{{ $language->name }}</p>
                        </div>

                        <!-- Enter Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>Code:</strong>
                            <p>{{ $language->code  }}</p>
                        </div>

                        <!-- script_type Field -->
                        <div class="form-group col-sm-12">
                            <strong >Script Type:</strong>
                            <p>{{ $language->script_type }}</p>
                        </div>

                        <!-- family Field -->
                        <div class="form-group col-sm-12">
                            <strong >Language Family:</strong>
                            <p>{{ $language->family }}</p>
                        </div>

                        <!-- Language Type Field -->
                        <div class="form-group col-sm-12">
                            <strong>Language Type:</strong>
                            <p>{{ $language->type }}</p>
                        </div>

                        <!-- Language Type ISO Code Field -->
                        <div class="form-group col-sm-12">
                            <strong>Language Type ISO Code:</strong>
                            <p>{{ $language->type_iso_code }}</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

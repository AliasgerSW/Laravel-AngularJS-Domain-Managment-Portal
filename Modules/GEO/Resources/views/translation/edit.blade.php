@extends('adminTheme.default')

@section('title', 'Edit Language')

@section('style')
    <style>
        .input-group{
            display: table-row;
        }
    </style>
@endsection


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
        <li class="active"> Edit Language</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Edit Language
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
    <script>
        $("input[name='code']").keyup(function(){
            $(".like-json").text($(this).val() + '.json');
        });
    </script>
@endsection
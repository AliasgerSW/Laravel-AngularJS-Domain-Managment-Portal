@extends('adminTheme.default')

@section('title', 'Show Address Proof')

@section('content-header')
    <h1>Show Address Proof</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('staffs.index') }}"> @lang('admin.staff.title')</a>
        </li>
        <li>
            <a href="{{ route('addressProofType.index') }}"> @lang('admin.AddressProofType.title')</a>
        </li>
        <li class="active"> @lang('admin.general.show')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="diagram" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Show Address Proof
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="form-group col-sm-12">
                            <strong >@lang('admin.AddressProofType.name'):</strong>
                            <p>{{ $addressProofTypes->proof_name }}</p>
                        </div>

                        <!-- Description Field -->
                        <div class="form-group col-sm-12">
                            <strong>@lang('admin.AddressProofType.description'):</strong>
                            <p>{{ $addressProofTypes->proof_descr }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

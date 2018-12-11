@extends('adminTheme.default')

@if (!empty($addressProofType))
    @section('title', __('admin.general.edit') . ' ' . __('admin.AddressProofType.title'))
@else
    @section('title', __('admin.general.create') . ' ' . __('admin.AddressProofType.title'))
@endif

@section('content-header')
    <h1>@lang('admin.AddressProofType.title')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="{{ route('staffs.index') }}"> @lang('admin.AddressProofType.title')</a>
        </li>
        <li>
            <a href="{{ route('addressProofType.index') }}"> @lang('admin.AddressProofType.title')</a>
        </li>
        @if (!empty($addressProofType))
            <li class="active"> @lang('admin.general.edit')</li>
        @else
            <li class="active"> @lang('admin.general.create')</li>
        @endif
    </ol>
@endsection

@section('style')
    <link href="{{ asset('adminTheme/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" ng-app="DSM">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="map" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> @lang('admin.general.create')
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ (!empty($addressProofType) ? route('addressProofType.update', $addressProofType->id) : route('addressProofType.store'))  }}"
                          name="positionForm" class="form-horizontal" method="POST" novalidate>
                        @csrf
                        @if (!empty($addressProofType))
                            @method('PUT')
                        @endif
                        <fieldset>
                        @include('staff::addressProofTypes.fields')
                        <!-- Submit Field -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success"><i
                                            class="fa fa-fw fa-save"></i> @lang('admin.general.submit')
                                </button>
                                <a href="{!! route('addressProofType.index') !!}" class="btn btn-danger"><i
                                            class="fa fa-fw fa-times"></i> @lang('admin.general.cancel')</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('adminTheme/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script>
        $("#accepted_at").select2({
            placeholder: 'Select an Country'
        });
    </script>
@endsection

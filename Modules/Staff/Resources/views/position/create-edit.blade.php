@extends('adminTheme.default')
@if (!empty($position))
    @section('title', __('admin.general.edit') . ' ' . __('admin.staffPosition.title'))
@else
    @section('title', __('admin.general.create') . ' ' . __('admin.staffPosition.title'))
@endif
@section('content-header')
    <h1>@lang('admin.staffPosition.title')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="{{ route('staffs.index') }}"> @lang('admin.staff.title')</a>
        </li>
        <li>
            <a href="{{ route('position.index') }}"> @lang('admin.staffPosition.title')</a>
        </li>
        @if (!empty($position))
            <li class="active"> @lang('admin.general.edit')  @lang('admin.staffPosition.title')</li>
        @else
            <li class="active"> @lang('admin.general.create')  @lang('admin.staffPosition.title')</li>
        @endif
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary" ng-app="DSM">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="diagram" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Create @lang('admin.staffPosition.title')
                    </div>
                </div>
                <div class="portlet-body" ng-controller="staffPositionController">
                    <form action="{{ (!empty($position) ? route('position.update', $position->id) : route('position.store'))  }}"
                          name="positionForm" ng-submit="submitPosition()" class="form-horizontal ng-valid ng-pristine"
                          method="POST" novalidate>
                        @csrf
                        @if (!empty($position))
                            @method('PUT')
                        @endif
                        <fieldset>
                        @include('staff::position.fields')
                        <!-- Submit Field -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success" ng-disabled="positionForm.$invalid"><i
                                            class="fa fa-fw fa-save"></i> @lang('admin.general.submit')
                                </button>
                                <a href="{!! route('position.index') !!}" class="btn btn-danger"><i
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
    <script>
        DSM.controller('staffPositionController', function ($rootScope, $scope) {
            $scope.codeRegex = /^[a-zA-Z0-9_]*$/;

            $scope.submitPosition = function () {
                if ($scope.positionForm.$invalid) {
                    angular.forEach($scope.positionForm.$error, function (field) {
                        angular.forEach(field, function (errorField) {
                            errorField.$setTouched();
                        })
                    });
                    return false;
                } else {
                    return true;
                }
            }
        });
    </script>
@endsection
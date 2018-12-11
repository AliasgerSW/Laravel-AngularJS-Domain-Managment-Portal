@extends('adminTheme.default')

@section('title', $pageLabel.' '.__('admin.staff.title'))

@section('content-header')
    <h1>{{$pageLabel}} @lang('admin.staff.title')</h1>
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
        <li class="active"> {{$pageLabel}} @lang('admin.staff.title')</li>
    </ol>
@endsection

@section('content')
    <div class="row" ng-app="DSM">
        <div class="col-md-12" ng-controller="staffController">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> {{$pageLabel}} @lang('admin.staff.title')
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ !empty($staff) ? route('staffs.update', $staff->id) : route('staffs.store') }}"
                          class="form-horizontal ng-pristine ng-valid" method="POST" ng-submit="submitStaff()"
                          enctype="multipart/form-data" name="staffForm" novalidate>
                        @if(!empty($staff))
                            @method('PUT')
                        @endif

                        @csrf
                        <fieldset ng-show="currStep==1">
                            <legend>@lang('admin.staff.step1')</legend>
                            @include('staff::staff.fields_step1')
                        </fieldset>
                        <fieldset ng-show="currStep==2">
                            <legend>@lang('admin.staff.step2')</legend>
                            @include('staff::staff.fields_step2')
                        </fieldset>
                        <fieldset ng-show="currStep==3">
                            <legend>@lang('admin.staff.step3')</legend>
                            @include('staff::staff.fields_step3')
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button class="btn btn-primary pull-right" type="button" ng-click="nextStep()"
                                            ng-show="currStep < 3">@lang('admin.general.next') <span
                                                class="fa fa-arrow-right"></span></button>
                                    <button class="btn btn-primary pull-right" type="submit"
                                            ng-show="currStep >= 3">@lang('admin.general.submit') <span
                                                class="fa fa-file"></span></button>
                                    <button class="btn btn-danger" type="button" ng-click="prevStep()"><span
                                                class="fa fa-arrow-left"></span> @lang('admin.general.previous')
                                    </button>
                                </div>
                                {{--<div class="col-md-12">--}}
                                {{--<% staffForm.$error %>--}}
                                {{--</div>--}}
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
        DSM.controller('staffController', function ($rootScope, $scope, $http) {
            $scope.currStep = 1;
            $scope.staffForm = {};
            $scope.status = 'active';
            $scope.gender = 'M';
            $scope.staff_type = 'P';
            $scope.country_id = "{{ isset($staff->country_id) ? $staff->country_id : '' }}";
            $scope.state_id = "{{ isset($staff->state_id) ? $staff->state_id : '' }}";
            $scope.city_id = "{{ !empty($staff->city_id) ? $staff->city_id : '' }}";
            $scope.isEditMode = {{ !empty($staff) ? 'true' : 'false'  }};
            $scope.p_email = '';

            $scope.phoneRegex = /^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/;
            $scope.usernameRegex = /^[a-zA-Z0-9_]*$/;
            $scope.zipRegex = /^\d{5}(?:[-\s]\d{4})?$/;
            $scope.passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])/;


            $scope.nextStep = function () {
                if ($scope.currStep >= 3) return;

                if ($scope.staffForm.$invalid) {
                    angular.forEach($scope.staffForm.$error, function (field) {
                        angular.forEach(field, function (errorField) {
                            errorField.$setTouched();
                        })
                    });

                } else {
                    $scope.currStep = $scope.currStep + 1;

                }
            }

            $scope.prevStep = function () {
                if ($scope.currStep <= 1) return;
                $scope.currStep = $scope.currStep - 1;
            }

            $scope.submitStaff = function () {
                if ($scope.staffForm.$invalid) {
                    angular.forEach($scope.staffForm.$error, function (field) {
                        angular.forEach(field, function (errorField) {
                            errorField.$setTouched();
                        })
                    });
                    return false;
                } else {
                    return true;
                }
            }

            $scope.$watchCollection('[country_id]', function () {
                if ($scope.country_id) {
                    $scope.stateslist = [];
                    $scope.citieslist = [];
                    $scope.states($scope.country_id);
                }
            });

            $scope.initializingStates = false;
            $scope.stateslist = [];
            $scope.states = function (country) {
                var token = $("input[name='_token']").val();
                $scope.initializingStates = true;
                $http({
                    method: "post",
                    url: "{{ route('staff.states') }}",
                    data: {
                        country_id: country,
                        _token: token
                    }
                }).then(function (res) {
                    $scope.initializingStates = false;
                    $scope.stateslist = res.data;
                }, function (err) {
                    $scope.initializingStates = false;
                    $scope.stateslist = {};
                })
            }

            $scope.$watchCollection('[state_id]', function () {
                if ($scope.state_id && !$scope.initializingStates) {
                    $scope.citieslist = [];
                    $scope.cities($scope.state_id);
                }
            });

            $scope.citieslist = [];
            $scope.cities = function (state) {
                var token = $("input[name='_token']").val();

                $http({
                    method: "post",
                    url: "{{ route('staff.cities') }}",
                    data: {
                        state_id: state,
                        _token: token
                    }
                }).then(function (res) {
                    $scope.citieslist = res.data;
                }, function (err) {
                    $scope.citieslist = {};
                })
            }

            if ($scope.country_id) {
                $scope.states($scope.country_id);
            }

            if ($scope.state_id) {
                $scope.cities($scope.state_id);
            }
        })
    </script>
@endsection

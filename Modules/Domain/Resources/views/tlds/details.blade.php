@extends('adminTheme.default')

@section('title', __('admin.general.manage').' '.__('admin.tld.title'))

@section('style')
    <link href="{{ asset('adminTheme/css/pages/sortable_list.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/iCheck/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/iCheck/css/line/line.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/switchery/css/switchery.css') }}">
    <link href="{{ asset('adminTheme/vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('adminTheme/css/customTld.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.tld.title'): .COM</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('admin') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> @lang('admin.general.dashboard')
            </a>
        </li>
        <li>
            <a href="{{ route('tld.index')  }}">@lang('admin.tld.title')</a>
        </li>
        <li class="active"> @lang('admin.general.view')</li>
    </ol>
    @include('errors.list')
@endsection

@section('content')
    <div class="row tld-form" ng-app="DSM">
        <div class="col-md-12" ng-controller="tldDetailsController">
            @if(!empty($data['tld_store_error']))
                <div class="alert alert-danger">
                    <?php
                        foreach ($data['tld_store_error'] as $error) {
                    ?>
                    <p>{{$error}}</p>
                    <?php } ?>
                </div>

                @endif
            <form name="tldForm" novalidate action="{{ route('admin.domains.tld.store-tld') }}" method="post">
            {{ csrf_field() }}
                @if($data['is_edit'] == 1)
                    <input type="text" name="mtld_id" class="sr-only" value="{{$data['current_tld']->id}}" />
                @endif
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box primary-tld">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-th"></i> @lang('admin.tld.basic_details')
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2" ng-class="ce('product_name', 1)">
                            <label for="product_name">@lang('admin.tld.product_name'):<span class="error">*</span>
                            <validation-tooltip target="product_name" ng-cloak>
                                <ul class="list-unstyled">
                                    <li validation-message ng-if="$field.$error.required">@lang('admin.general.validation.required', ['attribute' => __('admin.tld.product_name') ])</li>
                                    <li validation-message ng-if="$field.$error.min">@lang('admin.general.validation.min', ['min' => '2', 'attribute' => __('admin.tld.product_name') ])</li>
                                </ul>
                            </validation-tooltip>
                            </label>
                            <input type="text" class="form-control" ng-class="ce('product_name')"
                                   validation-callback="onChange"
                                   ng-model="product_name" min="2" name="product_name" id="product_name"
                                   placeholder="Product Name..." ng-blur="change_cost_price()" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.opensrs') @lang('admin.geo.translation.key'):</label>
                            <input type="text" class="form-control" ng-model="opensrs_key" placeholder="@lang('admin.tld.opensrs') @lang('admin.geo.translation.key')..." disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.resellerclub') @lang('admin.geo.translation.key'):</label>
                            <input type="text" class="form-control" ng-model="reseller_club_key" placeholder="@lang('admin.tld.resellerclub') @lang('admin.geo.translation.key')..." disabled>
                        </div>
                        <div class="col-md-2" ng-class="ce('provider', 1)">
                            <label for="provider">@lang('admin.tld.provider_registrar'):
                                <validation-tooltip target="provider" ng-cloak>
                                    <ul class="list-unstyled">
                                        <li validation-message ng-if="$field.$error.required">@lang('admin.general.validation.required', ['elm' => __('admin.tld.provider_registrar') ])</li>
                                    </ul>
                                </validation-tooltip>
                            </label>
                            <select name="provider" id="provider" class="form-control" ng-model="provider"
                                    ng-class="ce('provider')"  ng-change="change_cost_price()" required>
                                <option value="OpenSRS">@lang('admin.tld.opensrs')</option>
                                <option value="ResellerClub">@lang('admin.tld.resellerclub')</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="suggest_group">@lang('admin.tld.suggest_group'):</label>
                            <select name="suggest_group" id="suggest_group" class="form-control"
                                    ng-model="suggest_group">
                                <option value="none">@lang('admin.general.none')</option>
                                <option value="promo">@lang('admin.tld.promocode_domain')</option>
                                <option value="popular">@lang('admin.tld.popular_domain')</option>
                                <option value="both">@lang('admin.general.both')</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="bulk_eligible_limit">@lang('admin.tld.bulkEligible') @lang('admin.tld.domain'):</label>
                            <select class="form-control" name="bulk_eligible_limit"
                                    ng-model="bulk_eligible_limit" ng-options="n for n in dropRange(0,20)">
                            </select>
                        </div>
                        <div class="col-md-2" ng-class="ce('max_register_years', 1)">
                            <label for="max_register_years">@lang('admin.general.max') @lang('admin.tld.registration'):
                                <validation-tooltip target="max_register_years" ng-cloak>
                                    <ul class="list-unstyled">
                                        <li validation-message ng-if="$field.$error.required">@lang('admin.general.validation.select', ['phrase' => 'Registeration Years'])</li>
                                    </ul>
                                </validation-tooltip>
                            </label>
                            <div class="form-group input-group">
                                <select class="form-control" name="max_register_years"
                                        ng-model-options="{ updateOn: 'blur' }" ng-model="max_register_years"
                                        ng-options="n for n in dropRange(0,20)" required>
                                </select>
                                <span class="input-group-addon">@lang('admin.general.year_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="min_register_years">@lang('admin.general.min') @lang('admin.tld.registration')</label>
                            <div class="form-group input-group">
                                <select class="form-control" name="min_register_years"
                                        ng-model="min_register_years" ng-options="n for n in dropRange(0, max_register_years)">
                                </select>
                                <span class="input-group-addon">@lang('admin.general.year_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2" ng-class="ce('max_renew_years', 1)">
                            <label for="max_renew_years">@lang('admin.general.max') @lang('admin.tld.renewal'):
                                <validation-tooltip target="max_renew_years" ng-cloak>
                                    <ul class="list-unstyled">
                                        <li validation-message ng-if="$field.$error.required">@lang('admin.general.validation.select', ['phrase' => 'Renewal Years'])</li>
                                    </ul>
                                </validation-tooltip>
                            </label>
                            <div class="form-group input-group" ng-class="">
                                <select class="form-control" name="max_renew_years"
                                        ng-model-options="{ updateOn: 'blur' }" ng-model="max_renew_years"
                                        ng-options="n for n in dropRange(0,20)" required>
                                </select>
                                <span class="input-group-addon">@lang('admin.general.year_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.general.min') @lang('admin.tld.renewal'):</label>
                            <div class="form-group input-group">
                                <select class="form-control" name="min_renew_years"
                                        ng-model="min_renew_years" ng-options="n for n in dropRange(0, max_renew_years)">
                                </select>
                                <span class="input-group-addon">@lang('admin.general.year_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.cancellation') @lang('admin.tld.period'):</label>
                            <div class="form-group input-group">
                                <input type="number" class="form-control e-error" placeholder="@lang('admin.general.day')..." min="0"
                                       ng-model="max_cancellation_period" id="max_cancellation_period"
                                       name="max_cancellation_period">
                                <span class="input-group-addon">@lang('admin.general.day_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.grace') @lang('admin.tld.period'):</label>
                            <div class="form-group input-group">
                                <input type="number" class="form-control" placeholder="@lang('admin.general.day')..." min="0"
                                       ng-model="grace_period" id="grace_period" name="grace_period">
                                <span class="input-group-addon">@lang('admin.general.day_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.restore') @lang('admin.tld.period'):</label>
                            <div class="form-group input-group">
                                <input type="number" class="form-control" placeholder="@lang('admin.general.day')..." min="0"
                                       ng-model="restore_period" id="restore_period" name="restore_period">
                                <span class="input-group-addon">@lang('admin.general.day_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.min') @lang('admin.tld.renewal') @lang('admin.general.limit'):</label>
                            <div class="form-group input-group">
                                <input type="number" class="form-control" placeholder="@lang('admin.general.day')..."
                                       ng-model="min_renewal_limit" id="min_renewal_limit" name="min_renewal_limit">
                                <span class="input-group-addon">+/- @lang('admin.general.day_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.max') @lang('admin.tld.renewal') @lang('admin.general.limit'):</label>
                            <div class="form-group input-group">
                                <input type="number" class="form-control" placeholder="@lang('admin.general.day')..." min="0"
                                       ng-model="max_renewal_limit" id="max_renewal_limit" name="max_renewal_limit">
                                <span class="input-group-addon">@lang('admin.general.day_s')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="renewal_price">@lang('admin.tld.renewal') @lang('admin.general.price'):
                                <validation-tooltip target="renewal_price" ng-cloak>
                                    <ul class="list-unstyled">
                                        <li validation-message ng-if="$field.$error.pattern">@lang('admin.general.validation.enter', ['phrase' => __('admin.tld.renewal') . __('admin.general.price')])</li>
                                    </ul>
                                </validation-tooltip>
                            </label>
                            <div class="form-group input-group">
                                <input type="text" class="form-control" placeholder="0,00" min="0" ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-model="renewal_price" id="renewal_price" name="renewal_price" price>
                                <span class="input-group-addon">@lang('admin.general.price')</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">@lang('admin.tld.') @lang('admin.general.price'):</label>
                            <div class="form-group input-group">
                                <input type="text" class="form-control" placeholder="0,00" min="0"
                                       ng-model="transfer_price" id="transfer_price" name="transfer_price" price>
                                <span class="input-group-addon">@lang('admin.general.price')</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-2" ng-cloak>
                            <label for="country_restricted">@lang('admin.tld.country_restricted'):</label>
                            <ui-select id="country_restricted" name="country_restricted" multiple ng-model="country_restricted.selectedItems" theme="bootstrap"
                                       title="Select Continents" style="height: auto;">
                                <ui-select-match placeholder="Select @lang('admin.tld.country_restricted')..."><% $item.name %></ui-select-match>
                                <ui-select-choices
                                        repeat="continent in country_restricted | filter: {name: $select.search}">
                                    <% continent.name %>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                        <input name="continentList" type="text" class="sr-only" value="<% country_restricted.selectedItems %>" />
                        <div class="col-md-2" ng-cloak>
                            <label for="">@lang('admin.geo.continents'):</label>
                            <ui-select id="continentList"  name="continentList" multiple ng-model="continentList.selectedItems" theme="bootstrap"
                                       title="Select Continents" style="height: auto;">
                                <ui-select-match placeholder="Select @lang('admin.geo.continents')..."><% $item.name %></ui-select-match>
                                <ui-select-choices
                                        repeat="continent in continentList | filter: {name: $select.search}">
                                    <% continent.name %>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                        <input name="continents" id="continents" type="text" class="sr-only" value="<% continentList.selectedItems %>" />
                        <div class="col-md-2" ng-cloak>
                            <label for="">@lang('admin.tld.categories'):</label>
                            <ui-select multiple ng-model="categoriesList.selectedItems" theme="bootstrap"
                                       title="Select Categories" style="height: auto;">
                                <ui-select-match placeholder="Select @lang('admin.tld.categories')..."><% $item.name %></ui-select-match>
                                <ui-select-choices
                                        repeat="category in categoriesList | filter: {name: $select.search}">
                                    <% category.name %>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                        <input name="categories" id="categories" type="text" class="sr-only" value="<% categoriesList.selectedItems %>" />
                        {{--<div class="col-md-2">
                            <label for="">Domain Contacts:</label>
                            <select name="contacts[]" id="" class="form-control select2" multiple>
                                <option value="1">India</option>
                                <option value="2">Brazil</option>
                            </select>
                            <ui-select multiple ng-model="categories.selectedItems" theme="bootstrap"
                                       title="Select Categories" style="height: auto;">
                                <ui-select-match placeholder="Select Categories..."><% $item.name %></ui-select-match>
                                <ui-select-choices
                                        repeat="category in categoriesList | filter: {name: $select.search}">
                                    <% category.name %>
                                </ui-select-choices>
                            </ui-select>
                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box primary-tld">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-money"></i> @lang('admin.tld.registration') @lang('admin.general.prices')
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-hover" ng-cloak>
                        <thead>
                        <tr>
                            <th style="width:135px"><i class="fa fa-calendar"></i> @lang('admin.general.duration')</th>
                            <th style="width:100px"><i class="fa fa-money"></i> @lang('admin.tld.cost') @lang('admin.general.price')</th>
                            <th style="min-width:130px"><i class="fa fa-money"></i> @lang('admin.tld.regular') @lang('admin.general.price')</th>
                            <th><i class="fa fa-suitcase"></i> @lang('admin.tld.promo') @lang('admin.general.from')</th>
                            <th><i class="fa fa-suitcase"></i> @lang('admin.tld.promo') @lang('admin.general.to')</th>
                            <th style="min-width:130px"><i class="fa fa-money"></i> @lang('admin.tld.promo') @lang('admin.general.price')</th>
                            <th style="min-width:130px"><i class="fa fa-money"></i> @lang('admin.tld.bulk') @lang('admin.general.price')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="dp in domain_prices">
                            <td>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Year..." name="domain_prices_year[]"
                                           ng-value="$index+1" ng-model="domain_prices[$index].year" readonly>
                                    <span class="input-group-addon">Year<% ($index == 0 ? '' : 's') %> </span>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="Price..." disabled=""
                                       name="domain_prices_price[]"
                                       ng-model="cost_price_of_particular_tld">
                            </td>
                            <td ng-class="ce2('domain_prices_regular_price', $index, 1)">
                                <input type="text" class="form-control"
                                       ng-class="ce2('domain_prices_regular_price', $index)"
                                       name="domain_prices_regular_price[<% $index %>]" required
                                       ng-model="domain_prices[$index].regular_price"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/" price />
                            </td>
                            <td>
                                <input type="text" class="form-control datepicker datepicker_rec_start"
                                       name="domain_prices_promo_from[]"
                                       placeholder="Promo From..."
                                       ng-model="domain_prices[$index].promo_from">
                            </td>
                            <td>
                                <input type="text" class="form-control datepicker datepicker_rec_start" name="domain_prices_promo_to[]"
                                       placeholder="Promo To..."
                                       ng-model="domain_prices[$index].promo_fto">
                            </td>
                            <td>
                                <input type="text" class="form-control" ng-model="domain_prices[$index].promo_price"
                                       ng-class="ce2('domain_prices_promo_price', $index)"
                                       name="domain_prices_promo_price[<% $index %>]" ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/" price>
                            </td>
                            <td>
                                <input type="text" class="form-control price-box"
                                       name="domain_prices_bulk_price[<% $index %>]"
                                       ng-class="ce2('domain_prices_bulk_price', $index)"
                                       ng-model="domain_prices[$index].bulk_price" ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/" price>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-3 text-last">
                            <label class="text-pp" for="cancellation_price">@lang('admin.tld.cancellation') @lang('admin.general.price'):
                                <validation-tooltip target="cancellation_price" ng-cloak>
                                    <ul class="list-unstyled">
                                        <li validation-message ng-if="$field.$error.pattern">@lang('admin.general.validation.enter', ['phrase' => __('admin.tld.cancellation') . __('admin.general.price')])</li>
                                    </ul>
                                </validation-tooltip>
                            </label>
                            <span><input type="text" class="form-control" ng-model="cancellation_price"
                                         name="cancellation_price" ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/" price/></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box primary-tld">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-money"></i> @lang('admin.tld.renewal_n_tfr_prices')
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-hover" ng-cloak>
                        <thead>
                        <tr>
                            <th style="width:135px"><i class="fa fa-calendar"></i> @lang('admin.general.duration')</th>
                            <th style="width:100px"><i class="fa fa-money"></i> @lang('admin.tld.cost') @lang('admin.general.price')</th>
                            <th style="min-width:130px"><i class="fa fa-money"></i> @lang('admin.tld.regular') @lang('admin.general.price')</th>
                            <th><i class="fa fa-suitcase"></i> @lang('admin.tld.promo') @lang('admin.general.from')</th>
                            <th><i class="fa fa-suitcase"></i> @lang('admin.tld.promo') @lang('admin.general.to')</th>
                            <th style="min-width:130px"><i class="fa fa-money"></i> @lang('admin.tld.promo') @lang('admin.general.price')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="rp in renewal_prices">
                            <td>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Year..." name="renewal_prices_year[]"
                                           ng-value="$index+1" ng-model="renewal_prices[$index].year" readonly>
                                    <span class="input-group-addon">Year<% ($index == 0 ? '' : 's') %> </span>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="Price..." disabled="" ng-model="cost_price_of_particular_tld">
                            </td>
                            <td ng-class="ce2('renewal_prices_regular_price', $index, 1)">
                                <input type="text" class="form-control" name="renewal_prices_regular_price[<% $index %>]"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce2('renewal_prices_regular_price', $index)"
                                       ng-model="renewal_prices[$index].regular_price" price required>
                            </td>
                            <td>
                                <input type="text" class="form-control datepicker datepicker_rec_start"
                                       name="renewal_prices_promo_from[]"
                                       placeholder="Promo From..."
                                       ng-model="renewal_prices[$index].promo_from">
                            </td>
                            <td>
                                <input type="text" class="form-control datepicker datepicker_rec_start"
                                       name="renewal_prices_promo_to[]"
                                       placeholder="Promo To..."
                                       ng-model="renewal_prices[$index].promo_fto">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="renewal_prices_promo_price[<% $index %>]"
                                       ng-class="ce2('renewal_prices_promo_price', $index)"
                                       ng-model="renewal_prices[$index].promo_price" price>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-3 text-last">
                            <label class="text-pp" for="restore_price">@lang('admin.tld.restoration') @lang('admin.general.price'):
                                <validation-tooltip target="restore_price" ng-cloak>
                                    <ul class="list-unstyled">
                                        <li validation-message ng-if="$field.$error.pattern">@lang('admin.general.validation.enter', ['phrase' => __('admin.tld.restoration') . __('admin.general.price')])</li>
                                    </ul>
                                </validation-tooltip>
                            </label>
                            <span><input type="text" class="form-control" ng-model="restore_price" name="restore_price" price></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box primary-tld">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-stack-exchange"></i> @lang('admin.tld.services_n_prices')
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width:180px"><i class="fa fa-th"></i> @lang('admin.tld.service_name')</th>
                            <th style="width:100px"><i class="fa fa-money"></i> @lang('admin.tld.cost') @lang('admin.general.price')</th>
                            <th style="min-width:130px"><i class="fa fa-th-large"></i> @lang('admin.tld.service_type')</th>
                            <th style="min-width:130px"><i class="fa fa-money"></i> @lang('admin.general.prices')</th>
                            <th style="min-width:130px"><i class="fa fa-money"></i> @lang('admin.tld.activation_fee')</th>
                            <th style="min-width:130px"><i class="fa fa-tasks"></i> @lang('admin.general.duration')</th>
                            <th style="min-width:60px"><i class="fa fa-check-square-o"></i> @lang('admin.general.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <label for="dns_cost_price">@lang('admin.tld.dns')</label>
                            </td>
                            <td>
                                <input type="text" name="dns_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['dns_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="dns_service_type" id="" class="form-control"
                                        ng-model="dns_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('dns_price', 1)">
                                <input name="dns_price" class="form-control" type="text"
                                       ng-disabled="dns_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('dns_price')"
                                       ng-required="dns_service_type != 'free'"
                                       ng-model="dns_price" price />
                            </td>
                            <td ng-class="ce('dns_act_fee', 1)">
                                <input name="dns_act_fee" class="form-control" type="text"
                                       ng-disabled="dns_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('dns_act_free')"
                                       ng-model="dns_act_free" price />
                            </td>
                            <td>
                                <select name="dns_duration" id="" class="form-control"
                                        ng-model="dns_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input name="dns_status" type="checkbox" class="js-switch"
                                       ng-model="dns_status"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_dns_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="privacy_protection_cost_price">@lang('admin.tld.privacy_protection')</label>
                            </td>
                            <td>
                                <input type="text" name="privacy_protection_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['privacy_protection_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="privacy_protection_service_type" id="" class="form-control" ng-model="privacy_protection_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid" selected>@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('privacy_protection_price', 1)">
                                <input type="text" name="privacy_protection_price" class="form-control"
                                       ng-disabled="privacy_protection_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('privacy_protection_price')"
                                       ng-required="privacy_protection_service_type != 'free'"
                                       ng-model="privacy_protect_price" price />
                            </td>
                            <td ng-class="ce('privacy_protection_act_fee', 1)">
                                <input type="text" name="privacy_protection_act_fee" class="form-control"
                                       ng-disabled="privacy_protection_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('privacy_protect_act_free')"
                                       ng-model="privacy_protect_act_free" price />
                            </td>
                            <td>
                                <select name="privacy_protection_duration" id="" class="form-control"
                                        ng-model="privacy_protection_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period">@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="privacy_protection_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_privacy_protection_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="theft_protection_cost_price">@lang('admin.tld.theft_protection')</label>
                            </td>
                            <td>
                                <input type="text" name="theft_protection_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['theft_protection_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="theft_protection_service_type" id="" class="form-control"
                                        ng-model="theft_protection_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('theft_protection_price', 1)">
                                <input type="text" name="theft_protection_price" class="form-control"
                                       ng-disabled="theft_protection_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('theft_protection_price')"
                                       ng-required="theft_protection_service_type != 'free'"
                                       ng-model="theft_protection_price" price />
                            </td>
                            <td ng-class="ce('theft_protection_act_fee', 1)">
                                <input type="text" name="theft_protection_act_fee" class="form-control"
                                       ng-disabled="theft_protection_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('theft_protection_act_fee')"
                                       ng-model="theft_protection_act_fee" price />
                            </td>
                            <td>
                                <select name="theft_protection_duration" id="" class="form-control"
                                        ng-model="theft_protection_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="theft_protection_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_theft_protection_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="gdrp_cost_price">@lang('admin.tld.gdpr_protection')</label>
                            </td>
                            <td>
                                <input type="text" name="gdrp_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['gdrp_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="gdrp_service_type" id="" class="form-control"
                                        ng-model="gdrp_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('gdrp_price', 1)">
                                <input type="text" name="gdrp_price" class="form-control"
                                       ng-disabled="gdrp_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('gdrp_price')"
                                       ng-required="gdrp_service_type != 'free'"
                                       ng-model="gdrp_price" price />
                            </td>
                            <td ng-class="ce('gdrp_act_fee', 1)">
                                <input type="text" name="gdrp_act_fee" class="form-control"
                                       ng-disabled="gdrp_act_fee != 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('gdrp_act_fee')"
                                       ng-model="gdrp_act_fee" price />
                            </td>
                            <td>
                                <select name="gdrp_duration" id="" class="form-control"
                                        ng-model="gdrp_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="gdrp_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && isset($data['selected_features_services'][0]->gdrp_protection_active) && $data['selected_features_services'][0]->gdrp_protection_active == 1) checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="domain_secret_cost_price">@lang('admin.tld.domain_secret')</label>
                            </td>
                            <td>
                                <input type="text" name="domain_secret_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['domain_secret_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="domain_secret_service_type" id="" class="form-control"
                                        ng-model="domain_secret_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('domain_secret_price', 1)">
                                <input type="text" name="domain_secret_price" class="form-control"
                                       ng-disabled="domain_secret_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('domain_secret_price')"
                                       ng-required="domain_secret_service_type != 'free'"
                                       ng-model="domain_secret_price" price />
                            </td>
                            <td ng-class="ce('domain_secret_act_fee', 1)">
                                <input type="text" name="domain_secret_act_fee" class="form-control"
                                       ng-disabled="domain_secret_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('domain_secret_act_fee')"
                                       ng-model="domain_secret_act_fee" price />
                            </td>
                            <td>
                                <select name="domain_secret_duration" id="" class="form-control"
                                        ng-model="domain_secret_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="domain_secret_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_domain_secret_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="dnssec_cost_price">@lang('admin.tld.DNSSEC')</label>
                            </td>
                            <td>
                                <input type="text" name="dnssec_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['dnssec_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="dnssec_service_type" id="" class="form-control"
                                        ng-model="dnssec_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('dnssec_price', 1)">
                                <input type="text" name="dnssec_price" class="form-control"
                                       ng-disabled="dnssec_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('dnssec_price')"
                                       ng-required="dnssec_service_type != 'free'"
                                       ng-model="dnssec_price" price />
                            </td>
                            <td ng-class="ce('dnssec_act_fee', 1)">
                                <input type="text" name="dnssec_act_fee" class="form-control"
                                       ng-disabled="dnssec_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('dnssec_act_fee')"
                                       ng-model="dnssec_act_fee" price />
                            </td>
                            <td>
                                <select name="dnssec_duration" id="" class="form-control"
                                        ng-model="dnssec_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="dnssec_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && isset($data['selected_features_services'][0]->dnssec_active) && $data['selected_features_services'][0]->dnssec_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="child_name_server_cost_price">@lang('admin.tld.child_name_server')</label>
                            </td>
                            <td>
                                <input type="text" name="child_name_server_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['child_name_server_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="child_name_server_service_type" id="" class="form-control"
                                        ng-model="child_name_server_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('child_name_server_price', 1)">
                                <input type="text" name="child_name_server_price" class="form-control"
                                       ng-disabled="child_name_server_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('child_name_server_price')"
                                       ng-required="child_name_server_service_type != 'free'"
                                       ng-model="child_name_server_price" price  />
                            </td>
                            <td ng-class="ce('child_name_server_act_fee', 1)">
                                <input type="text" name="child_name_server_act_fee" class="form-control"
                                       ng-disabled="child_name_server_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('child_name_server_act_fee')"
                                       ng-model="child_name_server_act_fee" price />
                            </td>
                            <td>
                                <select name="child_name_server_duration" id=""
                                        class="form-control" ng-model="child_name_server_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="child_name_server_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && isset($data['selected_features_services'][0]->is_child_name_server_active) && $data['selected_features_services'][0]->is_child_name_server_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="domain_forwarding_cost_price">@lang('admin.tld.domain_forwarding')</label>
                            </td>
                            <td>
                                <input type="text" name="domain_forwarding_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['domain_forwarding_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="domain_forwarding_service_type" id="" class="form-control"
                                        ng-model="domain_forwarding_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('domain_forwarding_price', 1)">
                                <input type="text" name="domain_forwarding_price" class="form-control"
                                       ng-disabled="domain_forwarding_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('domain_forwarding_price')"
                                       ng-required="domain_forwarding_service_type != 'free'"
                                       ng-model="domain_forwarding_price" price  />
                            </td>
                            <td ng-class="ce('domain_forwarding_act_fee', 1)">
                                <input type="text" name="domain_forwarding_act_fee" class="form-control"
                                       ng-disabled="domain_forwarding_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('domain_forwarding_act_fee')"
                                       ng-model="domain_forwarding_act_fee" price />
                            </td>
                            <td>
                                <select name="domain_forwarding_duration" id=""
                                        class="form-control" ng-model="domain_forwarding_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="domain_forwarding_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_domain_forwarding_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="wap_cost_price">@lang('admin.tld.WAP')</label>
                            </td>
                            <td>
                                <input type="text" name="wap_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['wap_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="wap_service_type" id="" class="form-control"
                                        ng-model="wap_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('wap_price', 1)">
                                <input type="text" name="wap_price" class="form-control"
                                       ng-disabled="wap_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('wap_price')"
                                       ng-required="wap_service_type != 'free'"
                                       ng-model="wap_price" price />
                            </td>
                            <td ng-class="ce('wap_act_fee', 1)">
                                <input type="text" name="wap_act_fee" class="form-control"
                                       ng-disabled="wap_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('wap_act_fee')"
                                       ng-model="wap_act_fee" price />
                            </td>
                            <td>
                                <select name="wap_duration" id="" class="form-control"
                                        ng-model="wap_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="wap_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_wap_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="chat_cost_price">@lang('admin.tld.chat')</label>
                            </td>
                            <td>
                                <input type="text" name="chat_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['chat_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="chat_service_type" id="" class="form-control"
                                        ng-model="chat_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('chat_price', 1)">
                                <input type="text" name="chat_price" class="form-control"
                                       ng-disabled="chat_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('chat_price')"
                                       ng-required="chat_service_type != 'free'"
                                       ng-model="chat_price" price />
                            </td>
                            <td ng-class="ce('chat_act_fee', 1)">
                                <input type="text" name="chat_act_fee" class="form-control"
                                       ng-disabled="chat_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('chat_act_fee')"
                                       ng-model="chat_act_fee" price />
                            </td>
                            <td>
                                <select name="chat_duration" id="" class="form-control"
                                        ng-model="chat_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="chat_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_chat_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="free_email_cost_price">@lang('admin.tld.free_email')</label>
                            </td>
                            <td>
                                <input type="text" name="free_email_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['free_email_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="free_email_service_type" id="" class="form-control"
                                        ng-model="free_email_service_type">
                                    <option value="free">Free</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('free_email_price', 1)">
                                <input type="text" name="free_email_price" class="form-control"
                                       ng-disabled="free_email_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('free_email_price')"
                                       ng-required="free_email_service_type != 'free'"
                                       ng-model="free_email_price" price />
                            </td>
                            <td ng-class="ce('free_email_act_fee', 1)">
                                <input type="text" name="free_email_act_fee" class="form-control"
                                       ng-disabled="free_email_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('free_email_act_fee')"
                                       ng-model="free_email_act_fee" price />
                            </td>
                            <td>
                                <select name="free_email_duration" id="" class="form-control"
                                        ng-model="free_email_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="free_email_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_free_email_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="name_servers_cost_price">@lang('admin.tld.name_servers')</label>
                            </td>
                            <td>
                                <input type="text" name="name_servers_cost_price" class="form-control"
                                       placeholder="Price..."
                                       value="{{$data['name_server_price_of_reseller_club']}}"
                                       readonly>
                            </td>
                            <td>
                                <select name="name_servers_service_type" id="" class="form-control"
                                        ng-model="name_servers_service_type">
                                    <option value="free">@lang('admin.general.free')</option>
                                    <option value="paid">@lang('admin.general.paid')</option>
                                </select>
                            </td>
                            <td ng-class="ce('name_servers_price', 1)">
                                <input type="text" name="name_servers_price" class="form-control"
                                       ng-disabled="name_servers_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('name_servers_price')"
                                       ng-required="name_servers_service_type != 'free'"
                                       ng-model="name_servers_price" price />
                            </td>
                            <td ng-class="ce('name_servers_act_fee', 1)">
                                <input type="text" name="name_servers_act_fee" class="form-control"
                                       ng-disabled="name_servers_service_type == 'free'"
                                       ng-pattern="/^[0-9]+(\,[0-9]{1,2})?$/"
                                       ng-class="ce('name_servers_act_fee')"
                                       ng-model="name_servers_act_fee" price />
                            </td>
                            <td>
                                <select name="name_servers_duration" id=""
                                        class="form-control" ng-model="name_servers_duration">
                                    <option value="Yearly" selected>@lang('admin.tld.yearly')</option>
                                    <option value="Domain Period" selected>@lang('admin.tld.domain_period')</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" name="name_servers_status" class="js-switch"
                                       @if($data['is_edit'] == 1 && $data['selected_features_services'][0]->is_name_server_active == 1)checked @elseif($data['is_edit'] == 0)checked @else @endif/>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-3 text-last">
                            <span class="text-pp">@lang('admin.general.max') @lang('admin.tld.name_servers'): </span>
                            <span>
                                {{--<input type="text" name="max_nameserver_limit"
                                       class="form-control price-box"
                                       ng-model="max_nameserver_limit" />--}}
                                <select class="form-control" name="max_nameserver_limit"
                                        ng-model="max_nameserver_limit" ng-options="n for n in dropRange(0,20)">
                                </select>
                            </span>
                        </div>
                        <div class="col-md-3 text-last" style="margin-left:10px">
                            <span class="text-pp">@lang('admin.general.min') @lang('admin.tld.name_servers'): </span>
                            <span>
                                {{--<input type="text" name="min_nameserver_limit"
                                       class="form-control price-box"
                                       ng-model="min_nameserver_limit" />--}}
                                <select class="form-control" name="min_nameserver_limit"
                                        ng-model="min_nameserver_limit" ng-options="n for n in dropRange(0,max_nameserver_limit)">
                            </select>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->

            <div class="row">
                <div class="col-md-12 text-center" style="margin: 20px 0px;" ng-cloak>
                    <button class="btn btn-success" ng-if="!tldForm.$valid" ng-click="validateForm($event)"><i class="fa fa-save"></i> @lang('admin.general.save')</button>
                    <button class="btn btn-success" ng-if="tldForm.$valid"><i class="fa fa-save"></i> @lang('admin.general.save')</button>
                    <a href="{{ route('tld.index')  }}" class="btn btn-danger"><i class="fa fa-times"></i> @lang('admin.general.cancel')</a>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('adminTheme/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/daterangepicker/js/daterangepicker.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('adminTheme/vendors/switchery/js/switchery.js') }}"></script>
    <script>

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                size: 'small',
                color: 'rgb(1, 188, 140)'
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('body').on('focus', ".datepicker_rec_start", function () {
                $(this).daterangepicker({
                    singleDatePicker: true,
                });
            });
        });

        DSM.controller('tldDetailsController', function ($scope, $timeout) {
            $scope.dropRange = function (start, end) {
                var optArray = [];
                for (var i = start; i <= end; i++) {
                    optArray.push(i);
                }
                return optArray;
            };


            $scope.suggest_group = 'none';
            $scope.continentList = [];
            $scope.country_restricted = [];
            $scope.categoriesList = [];
            $scope.cost_price_of_tld_reseller_club = [];
            $scope.cost_price_of_tld_open_srs = [];
            $scope.provider = 'ResellerClub';
            $scope.dns_service_type = 'free';
            $scope.privacy_protection_service_type = 'paid';
            $scope.theft_protection_service_type = 'free';
            $scope.gdrp_service_type = 'free';
            $scope.domain_secret_service_type = 'free';
            $scope.dnssec_service_type = 'free';
            $scope.child_name_server_service_type = 'free';
            $scope.domain_forwarding_service_type = 'free';
            $scope.wap_service_type = 'free';
            $scope.chat_service_type = 'free';
            $scope.free_email_service_type = 'free';
            $scope.name_servers_service_type = 'free';
            @if(isset($data['cost_price_of_tld_reseller_club']))
                @foreach($data['cost_price_of_tld_reseller_club'] as $key => $val)
                    @if(isset($val['addnewdomain']))
                    $scope.cost_price_of_tld_reseller_club.push({'tld':'{{$key}}','cost_price':'{{$val['addnewdomain'][1]}}'});
                    @endif
                @endforeach
                @endif
                    @if(isset($data['cost_price_of_tld_open_srs']))
                @foreach($data['cost_price_of_tld_open_srs'] as $key => $val)
                    @if(isset($val['addnewdomain']))
                    $scope.cost_price_of_tld_open_srs.push({'tld':'{{$key}}','cost_price':'{{$val['addnewdomain'][1]}}'});
                    @endif
                @endforeach
                @endif
            $scope.country_restricted.selectedItems = [];
            $scope.categoriesList.selectedItems = [];
            $scope.continentList.selectedItems = [];

            @if($data['is_edit'] == 1)
                @if(isset($data['selected_restricted_countries']))
                    @foreach($data['selected_restricted_countries'] as $selected_country)
                        $scope.country_restricted.selectedItems.push({'id':{{$selected_country->country_id}},'name':'{{$selected_country->name}}'});
                    @endforeach
                @endif

                @if(isset($data['selected_category']))
                    @foreach($data['selected_category'] as $selected_category)
                        $scope.categoriesList.selectedItems.push({'id':{{$selected_category->tld_group_id}},'name':'{{$selected_category->name}}'});
                    @endforeach
                @endif

                @if(isset($data['selected_continent']))
                    @foreach($data['selected_continent'] as $selected_continent)
                        $scope.continentList.selectedItems.push({'id':{{$selected_continent->continent_id}},'name':'{{$selected_continent->name}}'});
                    @endforeach
                @endif
            @endif

            function return_key_based_on_other_key(str,order,array,return_key,provider){
                for (var i = 0; i <array.length; i++) {
                    if(array[i][order] == str)
                        return array[i][return_key];
                }
            }
            function IsIn2Darray(str,order,array){
                for (var i = 0; i <array.length; i++) {
                    return array[i][order] == str;
                }
            }
            @foreach($data['tld_country'] as $country)
                if(IsIn2Darray('{{$country->id}}','id',$scope.country_restricted.selectedItems) == false)
                    $scope.country_restricted.push({'id':{{$country->id}},'name':'{{$country->name}}'});
            else if($scope.country_restricted.selectedItems.length == 0)
                $scope.country_restricted.push({'id':{{$country->id}},'name':'{{$country->name}}'});
            @endforeach

            @foreach($data['tld_groups'] as $category)
                if(IsIn2Darray('{{$category->id}}','id',$scope.categoriesList.selectedItems) == false)
                    $scope.categoriesList.push({'id':{{$category->id}},'name':'{{$category->name}}'});
                else if($scope.categoriesList.selectedItems.length == 0)
                    $scope.categoriesList.push({'id':{{$category->id}},'name':'{{$category->name}}'});
            @endforeach

            @foreach($data['all_continents'] as $continent)
            if(IsIn2Darray('{{$continent->id}}','id',$scope.continentList.selectedItems) == false)
                $scope.continentList.push({'id':{{$continent->id}},'name':'{{$continent->name}}'});
            else if($scope.continentList.selectedItems.length == 0)
                $scope.continentList.push({'id':{{$continent->id}},'name':'{{$continent->name}}'});

            @endforeach

            $timeout(function(){
                $scope.max_register_years = 10;
            }, 1000)

            $scope.dns_duration = 'Domain Period';
            $scope.privacy_protection_duration = 'Yearly';
            $scope.theft_protection_duration = 'Domain Period';
            $scope.gdrp_duration = 'Domain Period';
            $scope.domain_secret_duration = 'Domain Period';
            $scope.dnssec_duration = 'Domain Period';
            $scope.child_name_server_duration = 'Domain Period';
            $scope.domain_forwarding_duration = 'Domain Period';
            $scope.wap_duration = 'Domain Period';
            $scope.chat_duration = 'Domain Period';
            $scope.free_email_duration = 'Domain Period';
            $scope.name_servers_duration = 'Domain Period';

            @if($data['is_edit'] == 1)
            $scope.product_name = '{{$data['current_tld']->name}}';
            $scope.opensrs_key = '{{$data['current_tld']->opensrs_key}}';
            $scope.reseller_club_key = '{{$data['current_tld']->reseller_club_key}}';
            $scope.provider = '@if(isset($data['current_tld']->registra)){{$data['current_tld']->registrar}}@endif';
            $scope.suggest_group = '@if(isset($data['current_tld']->suggest_group)){{$data['current_tld']->suggest_group}} @endif';
            $scope.bulk_eligible_limit = @if(isset($data['current_tld']->bulk_price_limit)){{$data['current_tld']->bulk_price_limit}} @else 0 @endif;
            $scope.max_register_years = @if(isset($data['current_tld']->max_purchase_limit)){{$data['current_tld']->max_purchase_limit}} @else 0 @endif;
            $scope.min_register_years = @if(isset($data['current_tld']->min_purchase_limit)){{$data['current_tld']->min_purchase_limit}} @else  0 @endif;
            $scope.max_renew_years = @if(isset($data['current_tld']->max_renewal_limit)){{$data['current_tld']->max_renewal_limit}} @else 0 @endif;
            $scope.min_renew_years = @if(isset($data['current_tld']->min_renewal_limit)){{$data['current_tld']->min_renewal_limit}} @else 0 @endif;
            $scope.max_cancellation_period = @if(isset($data['current_tld']->max_cancellation_days)){{$data['current_tld']->max_cancellation_days}} @else 0 @endif;
            $scope.grace_period = @if(isset($data['current_tld']->grace_period)){{$data['current_tld']->grace_period}} @else 0 @endif;
            $scope.restore_period = @if(isset($data['current_tld']->restore_period)){{$data['current_tld']->restore_period}} @else 0 @endif;
            $scope.min_renewal_limit = @if(isset($data['current_tld']->min_renewal_time)){{$data['current_tld']->min_renewal_time}} @else 0 @endif;
            $scope.max_renewal_limit = @if(isset($data['current_tld']->max_renewal_limit)){{$data['current_tld']->max_renewal_limit}} @else 0 @endif;
            $scope.cancellation_price = @if(isset($data['current_tld']->cancellation_fees)) {{$data['current_tld']->cancellation_fees}} @else 0 @endif;
            $scope.restore_price = @if(isset($data['current_tld']->restore_price)) {{$data['current_tld']->restore_price}} @else 0 @endif;
            $scope.renewal_price = '@if(isset($data['current_tld']->renewal_price)){{$data['current_tld']->renewal_price}}@endif';
            $scope.transfer_price = '@if(isset($data['current_tld']->transfer_price)){{$data['current_tld']->transfer_price}}@endif';

            $scope.dns_service_type = '@if(isset($data['selected_features_services'][0]->dns_service_type)){{$data['selected_features_services'][0]->dns_service_type}}@endif';
            $scope.privacy_protection_service_type = '@if(isset($data['selected_features_services'][0]->privacy_protection_service_type)){{$data['selected_features_services'][0]->privacy_protection_service_type}}@endif';
            $scope.theft_protection_service_type = '@if(isset($data['selected_features_services'][0]->theft_protection_service_type)){{$data['selected_features_services'][0]->theft_protection_service_type}}@endif';
            $scope.gdrp_service_type = '@if(isset($data['selected_features_services'][0]->gdrp_protection_service_type)){{$data['selected_features_services'][0]->gdrp_protection_service_type}}@endif';
            $scope.domain_secret_service_type = '@if(isset($data['selected_features_services'][0]->domain_secret_service_type)){{$data['selected_features_services'][0]->domain_secret_service_type}}@endif';
            $scope.dnssec_service_type = '@if(isset($data['selected_features_services'][0]->dnssec_service_type)){{$data['selected_features_services'][0]->dnssec_service_type}}@endif';
            $scope.child_name_server_service_type = '@if(isset($data['selected_features_services'][0]->child_name_server_service_type)){{$data['selected_features_services'][0]->child_name_server_service_type}}@endif';
            $scope.domain_forwarding_service_type = '@if(isset($data['selected_features_services'][0]->domain_forwarding_service_type)){{$data['selected_features_services'][0]->domain_forwarding_service_type}}@endif';
            $scope.wap_service_type = '@if(isset($data['selected_features_services'][0]->wap_service_type)){{$data['selected_features_services'][0]->wap_service_type}}@endif';
            $scope.chat_service_type = '@if(isset($data['selected_features_services'][0]->chat_service_type)){{$data['selected_features_services'][0]->chat_service_type}}@endif';
            $scope.free_email_service_type = '@if(isset($data['selected_features_services'][0]->free_email_service_type)){{$data['selected_features_services'][0]->free_email_service_type}}@endif';
            $scope.name_servers_service_type = '@if(isset($data['selected_features_services'][0]->name_server_service_type)){{$data['selected_features_services'][0]->name_server_service_type}}@endif';

            $scope.dns_price = '@if(isset($data['selected_features_services'][0]->dns_price)){{$data['selected_features_services'][0]->dns_price}}@else 0 @endif';
            $scope.privacy_protect_price = '@if(isset($data['selected_features_services'][0]->privacy_protection_price)){{$data['selected_features_services'][0]->privacy_protection_price}}@else 0 @endif';
            $scope.theft_protection_price = '@if(isset($data['selected_features_services'][0]->theft_protection_price)){{$data['selected_features_services'][0]->theft_protection_price}}@else 0 @endif';
            $scope.gdrp_price = '@if(isset($data['selected_features_services'][0]->gdrp_protection_price)){{$data['selected_features_services'][0]->gdrp_protection_price}}@else 0 @endif';
            $scope.domain_secret_price = '@if(isset($data['selected_features_services'][0]->domain_secret_price)){{$data['selected_features_services'][0]->domain_secret_price}}@else 0 @endif';
            $scope.dnssec_price = '@if(isset($data['selected_features_services'][0]->dnssec_price)){{$data['selected_features_services'][0]->dnssec_price}}@else 0 @endif';
            $scope.child_name_server_price = '@if(isset($data['selected_features_services'][0]->child_name_server_price)){{$data['selected_features_services'][0]->child_name_server_price}}@else 0 @endif';
            $scope.domain_forwarding_price = '@if(isset($data['selected_features_services'][0]->domain_forwarding_price)){{$data['selected_features_services'][0]->domain_forwarding_price}}@else 0 @endif';
            $scope.wap_price = '@if(isset($data['selected_features_services'][0]->wap_price)){{$data['selected_features_services'][0]->wap_price}}@else 0 @endif';
            $scope.chat_price = '@if(isset($data['selected_features_services'][0]->chat_price)){{$data['selected_features_services'][0]->chat_price}}@else 0 @endif';
            $scope.free_email_price = '@if(isset($data['selected_features_services'][0]->free_email_price)){{$data['selected_features_services'][0]->free_email_price}}@else 0 @endif';
            $scope.name_servers_price = '@if(isset($data['selected_features_services'][0]->name_server_price)){{$data['selected_features_services'][0]->name_server_price}}@else 0 @endif';

            $scope.dns_act_free = '@if(isset($data['selected_features_services'][0]->dns_activation_fee)){{$data['selected_features_services'][0]->dns_activation_fee}}@else 0 @endif';
            $scope.privacy_protect_act_free = '@if(isset($data['selected_features_services'][0]->privacy_protection_activation_fee)){{$data['selected_features_services'][0]->privacy_protection_activation_fee}}@else 0 @endif';
            $scope.theft_protection_act_fee = '@if(isset($data['selected_features_services'][0]->theft_protection_activation_fee)){{$data['selected_features_services'][0]->theft_protection_activation_fee}}@else 0 @endif';
            $scope.gdrp_act_fee = '@if(isset($data['selected_features_services'][0]->gdrp_protection_activation_fee)){{$data['selected_features_services'][0]->gdrp_protection_activation_fee}}@else 0 @endif';
            $scope.domain_secret_act_fee = '@if(isset($data['selected_features_services'][0]->domain_secret_activation_fee)){{$data['selected_features_services'][0]->domain_secret_activation_fee}}@else 0 @endif';
            $scope.dnssec_act_fee = '@if(isset($data['selected_features_services'][0]->dnssec_activation_fee)){{$data['selected_features_services'][0]->dnssec_activation_fee}}@else 0 @endif';
            $scope.child_name_server_act_fee = '@if(isset($data['selected_features_services'][0]->child_name_server_activation_fee)){{$data['selected_features_services'][0]->child_name_server_activation_fee}}@else 0 @endif';
            $scope.domain_forwarding_act_fee = '@if(isset($data['selected_features_services'][0]->domain_forwarding_activation_fee)){{$data['selected_features_services'][0]->domain_forwarding_activation_fee}}@else 0 @endif';
            $scope.wap_act_fee = '@if(isset($data['selected_features_services'][0]->wap_activation_fee)){{$data['selected_features_services'][0]->wap_activation_fee}}@else 0 @endif';
            $scope.chat_act_fee = '@if(isset($data['selected_features_services'][0]->chat_activation_fee)){{$data['selected_features_services'][0]->chat_activation_fee}}@else 0 @endif';
            $scope.free_email_act_fee = '@if(isset($data['selected_features_services'][0]->free_email_activation_fee)){{$data['selected_features_services'][0]->free_email_activation_fee}}@else 0 @endif';
            $scope.name_servers_act_fee = '@if(isset($data['selected_features_services'][0]->name_server_activation_fee)){{$data['selected_features_services'][0]->name_server_activation_fee}}@else 0 @endif';

            $scope.dns_duration = '@if(isset($data['selected_features_services'][0]->dns_duration)){{$data['selected_features_services'][0]->dns_duration}}@endif';
            $scope.privacy_protection_duration = '@if(isset($data['selected_features_services'][0]->privacy_protection_duration)){{$data['selected_features_services'][0]->privacy_protection_duration}}@endif';
            $scope.theft_protection_duration = '@if(isset($data['selected_features_services'][0]->theft_protection_duration)){{$data['selected_features_services'][0]->theft_protection_duration}}@endif';
            $scope.gdrp_duration = '@if(isset($data['selected_features_services'][0]->gdrp_protection_duration)){{$data['selected_features_services'][0]->gdrp_protection_duration}}@endif';
            $scope.domain_secret_duration = '@if(isset($data['selected_features_services'][0]->domain_secret_duration)){{$data['selected_features_services'][0]->domain_secret_duration}}@endif';
            $scope.dnssec_duration = '@if(isset($data['selected_features_services'][0]->dnssec_duration)){{$data['selected_features_services'][0]->dnssec_duration}}@endif';
            $scope.child_name_server_duration = '@if(isset($data['selected_features_services'][0]->child_name_server_duration)){{$data['selected_features_services'][0]->child_name_server_duration}}@endif';
            $scope.domain_forwarding_duration = '@if(isset($data['selected_features_services'][0]->domain_forwarding_duration)){{$data['selected_features_services'][0]->domain_forwarding_duration}}@endif';
            $scope.wap_duration = '@if(isset($data['selected_features_services'][0]->wap_duration)){{$data['selected_features_services'][0]->wap_duration}}@endif';
            $scope.chat_duration = '@if(isset($data['selected_features_services'][0]->chat_duration)){{$data['selected_features_services'][0]->chat_duration}}@endif';
            $scope.free_email_duration = '@if(isset($data['selected_features_services'][0]->free_email_duration)){{$data['selected_features_services'][0]->free_email_duration}}@endif';
            $scope.name_servers_duration = '@if(isset($data['selected_features_services'][0]->name_server_duration)){{$data['selected_features_services'][0]->name_server_duration}}@endif';

            $scope.min_nameserver_limit = '@if(isset($data['selected_features_services'][0]->min_nameserver_limit)){{$data['selected_features_services'][0]->min_nameserver_limit}}@endif';
            $scope.max_nameserver_limit = '@if(isset($data['selected_features_services'][0]->max_nameserver_limit)){{$data['selected_features_services'][0]->max_nameserver_limit}}@endif';
            $scope.renewal_price = '@if(isset($data['selected_features_services'][0]->renewal_price)){{$data['selected_features_services'][0]->renewal_price}}@endif';
            {{--@foreach($data['selected_restricted_countries'] as $selected_country)
            @foreach($data['selected_restricted_countries'] as $selected_country)
            //$scope.country_restricted =  {selectedItems: [{id: '{{$selected_country->country_id}}'}]};
            @endforeach--}}
            @endif

                $scope.cost_price_of_particular_tld = return_key_based_on_other_key($scope.product_name,'tld',$scope.cost_price_of_tld_reseller_club,'cost_price',$scope.provider);
            $scope.change_cost_price = function() {

                if($scope.provider == 'ResellerClub')
                    $scope.cost_price_of_particular_tld = return_key_based_on_other_key($scope.product_name,'tld',$scope.cost_price_of_tld_reseller_club,'cost_price',$scope.provider);
                else if($scope.provider == 'OpenSRS')
                    $scope.cost_price_of_particular_tld = return_key_based_on_other_key($scope.product_name,'tld',$scope.cost_price_of_tld_open_srs,'cost_price',$scope.provider);
            };


            $scope.domain_prices = [];
            $scope.$watch('max_register_years', function (next, previous) {
                if (previous) {
                    if (previous > next) {
                        var difference = (previous - next);
                        if (confirm('This will remove last ' + difference + ' rows from regular prices. Are you sure ?')) {
                            count = 0;
                            while (count < difference) {
                                $scope.domain_prices.pop();
                                count++;
                            }

                            return;
                        } else {
                            $scope.max_register_years = previous;
                            return;
                        }
                    }
                }
                var selected_prices = [];
                var count = $scope.domain_prices.length;
                @if($data['is_edit'] == 1)
                    var selected_prices = <?php echo json_encode($data['selected_prices']); ?>;
                @endif

                while (count < $scope.max_register_years) {
                    $scope.domain_prices.push([]);
                    @if($data['is_edit'] == 1)
                    $scope.domain_prices[count].regular_price = selected_prices[count]['regular_price'];
                    $scope.domain_prices[count].promo_price = selected_prices[count]['promo_price'];
                    $scope.domain_prices[count].promo_from = selected_prices[count]['promo_from'];
                    $scope.domain_prices[count].promo_fto = selected_prices[count]['promo_to'];
                    $scope.domain_prices[count].bulk_price = selected_prices[count]['bulk_price'];
                    @endif
                    count++;
                }
            })

            $scope.renewal_prices = [];
            $scope.$watch('max_renew_years', function (next, previous) {
                if (previous) {
                    if (previous > next) {
                        var difference = (previous - next);
                        if (confirm('This will remove last ' + difference + ' rows from regular prices. Are you sure ?')) {
                            count = 0;
                            while (count < difference) {
                                $scope.renewal_prices.pop();
                                count++;
                            }

                            return;
                        } else {
                            $scope.max_renew_years = previous;
                            return;
                        }
                    }
                }
                var count = $scope.renewal_prices.length;
                        @if($data['is_edit'] == 1)
                var selected_renewal_prices = <?php echo json_encode($data['selected_renewal_prices']); ?>;
                @endif
                while (count < $scope.max_renew_years) {
                    $scope.renewal_prices.push([]);
                    @if($data['is_edit'] == 1)
                        $scope.renewal_prices[count].regular_price = selected_renewal_prices[count]['renewal_price'];
                    $scope.renewal_prices[count].promo_from = selected_renewal_prices[count]['promo_from'];
                    $scope.renewal_prices[count].promo_fto = selected_renewal_prices[count]['promo_to'];
                    $scope.renewal_prices[count].promo_price = selected_renewal_prices[count]['promo_price'];
                    @endif
                    count++;
                }
            })

            $scope.ce = function(elementName, HE){
                if (!$scope.tldForm[elementName]){
                    return;
                }
                if ($scope.tldForm[elementName].$touched && $scope.tldForm[elementName].$error){
                    if (HE){
                        return 'has-error';
                    } else {
                        return 'error';
                    }
                } else {
                    return '';
                }
            }

            $scope.ce2 = function(elmPrefix, index, HE){
                var elementName = elmPrefix + '[' + index + ']';
                if (!$scope.tldForm[elementName]){
                    return;
                }

                if ($scope.tldForm[elementName].$touched &&
                    $scope.tldForm[elementName].$error &&
                    Object.keys($scope.tldForm[elementName].$error).length > 0){
                    if (HE){
                        return 'has-error';
                    } else {
                        return 'error';
                    }
                } else {
                    return '';
                }
            }

            $scope.validateForm = function($event){
                angular.forEach($scope.tldForm.$error, function (field) {
                    angular.forEach(field, function (errorField) {
                        errorField.$setTouched();
                    })
                });
                $event.preventDefault();
                return false;
            }
        })
    </script>
@endsection
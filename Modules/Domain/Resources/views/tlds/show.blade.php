@extends('adminTheme.default')

@section('title','Manage Tlds')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('adminTheme/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('adminTheme/vendors/select2/css/select2-bootstrap.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('adminTheme/vendors/x-editable/css/bootstrap-editable.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('adminTheme/vendors/x-editable/css/typeahead.js-bootstrap.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('adminTheme/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/css/pages/inlinedit.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminTheme/vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content-header')
    <h1>Manage Tld</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('admin') }}}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#">Tlds</a>
        </li>
        <li class="active">Manage</li>
    </ol>
    @include('errors.list')
@endsection

@section('content')
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="livicon" data-name="medal" data-size="16" data-loop ="true" data-c="#fff" data-hc="white"></i>
                    Manage TLD: {{$tld->name}}
                </h4>
            </div>
            <div class="panel-body">



            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="tags" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Manage Limit and Price
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td>Minimum Registration Year</td>
                                <td>
                                    <a href="#" id="min-reg-year" data-type="select" data-pk="{{ $tld->id }}" data-title="Please Select Minimum Registration Year" class="editable editable-click">
                                    {{ $tld->min_purchase_limit }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Maximum Registration Year</td>
                                <td>
                                    <a id="max-reg-year" data-type="select" data-pk="{{ $tld->id }}" data-title="Select Maximum Registration Year" class="editable editable-click" data-original-title="" title="">
                                    {{ $tld->max_purchase_limit }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Minimum Renewal Year</td>
                                <td>
                                    <a href="#" id="min-renewal-year" data-type="select" data-pk="{{ $tld->id }}" data-title="Please Provide Minimum Renewal Year" class="editable editable-click">
                                        {{ $tld->min_renewal_limit }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Maximum Renewal Year</td>
                                <td>
                                    <a href="#" id="max-renewal-year" data-type="select" data-pk="{{ $tld->id }}" data-title="Please Provide Maximum Renewal Year" class="editable editable-click">
                                        {{ $tld->max_renewal_limit }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Maximum Cancellation Day</td>
                                <td>
                                    <a href="#" id="max-cancel-day" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Provide Maximum Cancellation Day" class="editable editable-click">
                                        {{ $tld->max_cancellation_days }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Minimum Renewal Time</td>
                                <td>
                                    <a href="#" id="min-renewal-time" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Provide Minimumm Renewal Time" class="editable editable-click">
                                        {{ $tld->min_renewal_time }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Grace Period</td>
                                <td>
                                    <a href="#" id="grace-period" data-type="text" data-pk="{{ $tld->id }}"  data-title="Please Provide Grace Period" class="editable editable-click">
                                        {{ $tld->grace_period }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Restore Period</td>
                                <td>
                                    <a href="#" id="restore-period" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Provide Restore Period" class="editable editable-click">
                                        {{ $tld->restore_period }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Restore Price</td>
                                <td>
                                    <a href="#" id="restore-price" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Provide Restore Price" class="editable editable-click">
                                        {{ $tld->restore_price }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Transfer Price</td>
                                <td>
                                    <a href="#" id="transfer-price" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Provide Transfer Price" class="editable editable-click">
                                        {{ $tld->transfer_price }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Bulk Price Limit</td>
                                <td>
                                    <a href="#" id="bulk-price-limit" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Provide Bulk Price Limit" class="editable editable-click">
                                        {{ $tld->bulk_price_limit }}
                                    </a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="tags" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Manage TLD Feature Service
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td>DNS Status</td>
                                <td>
                                    <a href="#" id="dns-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Select DNS Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_dns_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_dns_active == '0')
                                                inactive
                                            @endif
                                        @endif

                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>DNS Price</td>
                                <td>
                                    <a id="dns-price" data-type="text"  data-pk="{{ $tld->id }}" data-title="Please Enter the Price of DNS" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            {{ $tld->tldFeatureService->dns_price }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Privacy Protection Status</td>
                                <td>
                                    <a href="#" id="privacy-status" data-type="select" data-pk="{{ $tld->id }}" data-title="Please Select Privacy Protection Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_privacy_protection_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_privacy_protection_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Privacy Protection Price</td>
                                <td>
                                    <a href="#" id="privacy-price" data-type="text" data-pk="{{ $tld->id }}"  data-title="Please Enter Price for the Privacy Protection" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            {{ $tld->tldFeatureService->privacy_protection_price }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Theft Protection Status</td>
                                <td>
                                    <a href="#" id="theft-protection-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Select Status of Thief Protection" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_theft_protection_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_theft_protection_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Thief Protection Price</td>
                                <td>
                                    <a href="#" id="theft-protection-price" data-type="text" data-pk="{{ $tld->id }}"  data-title="Please Enter Thief Protection Price" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            {{ $tld->tldFeatureService->theft_protection_price }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Child Nameserver Status</td>
                                <td>
                                    <a href="#" id="child-nameserver-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Enter Status of Child Nameserver" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_child_nameserver_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_child_nameserver_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Child Nameserver Price</td>
                                <td>
                                    <a href="#" id="child-nameserver-price" data-type="text"  data-pk="{{ $tld->id }}" data-title="Please Enter Price for Child Nameserver" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            {{ $tld->tldFeatureService->child_nameserver_price }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Domain Secret Status</td>
                                <td>
                                    <a href="#" id="domain-secret-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Enter Domain Secret Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_domain_secret_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_domain_secret_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Domain Forwarding Status</td>
                                <td>
                                    <a href="#" id="domain-forward-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Select Domain Forwarding Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_domain_forwarding_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_domain_forwarding_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Nameserver Status</td>
                                <td>
                                    <a href="#" id="nameserver-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Select Nameserver Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_nameserver_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_nameserver_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Minimum Nameserver Limit</td>
                                <td>
                                    <a href="#" id="min-nameserver-limit" data-type="text" data-pk="{{ $tld->id }}"  data-title="Please Enter Minimum Nameserver Limit" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                           {{ $tld->tldFeatureService->min_nameserver_limit }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Maximum Nameserver Limit</td>
                                <td>
                                    <a href="#" id="max-nameserver-limit" data-type="text" data-pk="{{ $tld->id }}"  data-title="Enter Maximum Nameserver Limit" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            {{ $tld->tldFeatureService->max_nameserver_limit }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>WAP Status</td>
                                <td>
                                    <a href="#" id="wap-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Select WAP Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_wap_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_wap_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Chat Status</td>
                                <td>
                                    <a href="#" id="chat-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Select Chat Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_chat_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_chat_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Free Email Status</td>
                                <td>
                                    <a href="#" id="free-email-status" data-type="select" data-pk="{{ $tld->id }}"  data-title="Please Select Free Email Status" class="editable editable-click">
                                        @if($tld->tldFeatureService)
                                            @if($tld->TldFeatureService->is_free_email_active == '1')
                                                active
                                            @elseif($tld->TldFeatureService->is_free_email_active == '0')
                                                inactive
                                            @endif
                                        @endif
                                    </a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="tags" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Manage Suggest Group and Category
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>

                            <tr>
                                <td>Suggest Group</td>
                                <td>
                                    <a href="#" id="sugest-group" data-type="select" data-pk="{{ $tld->id }}" data-title="Please Select Suggest Group" class="editable editable-click">
                                        {{ $tld->suggest_group }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Continents</td>
                                <td>
                                    <a id="continent" data-type="checklist" data-pk="{{ $tld->id }}" data-value="{{ str_replace(array('[',']','"'), '', $tld->continents()->pluck('continents.id')) }}" data-title="Please Select Continent" class="editable editable-click" data-original-title="" title="">

                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Category Group</td>
                                <td>
                                    <a href="#" id="category-group" data-type="checklist" data-pk="{{ $tld->id }}" data-value="{{ str_replace(array('[',']','"'), '', $tld->tldGroups()->pluck('tld_groups.id')) }}" data-title="Please Select Category Group" class="editable editable-click">

                                    </a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="tags" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Manage Promo Price
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="user" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Year</th>
                                <th>Regular Price</th>
                                <th>Promo Price</th>
                                <th>Promo From</th>
                                <th>Promo Till</th>
                                <th>Bulk Price</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody id="price-body">
                            @foreach($tld->tldsPrices as $price)
                                <tr data-id="{{ $price->id }}" class="tlds-prices-{{$price->id}}">
                                    <td>
                                        <a href="#" id="year" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Enter Year" class="editable editable-click year">
                                            {{ $price->year }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="promo-regular-price" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Enter Regular Price" class="promo-regular-price editable editable-click">
                                            {{ $price->regular_price }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="promo-price" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Enter Promo Price" class="promo-price editable editable-click">
                                            {{ $price->promo_price }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="promo-from" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Select Starting Date of Promo Price" class="promo-from editable editable-click">
                                            {{ $price->promo_from }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="promo-to" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Select Ending Date of Promo Price" class="promo-to editable editable-click">
                                            {{ $price->promo_to }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="bulk-price" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Enter Bulk Price" class="bulk-price editable editable-click">
                                            {{ $price->bulk_price }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="promo-remove-btn">Remove</a>
                                    </td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button class="btn btn-primary" id="add-promo-btn" data-toggle="modal" data-target="#add-price-modal">ADD Price</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="tags" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Manage Renewal Price
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="user" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Year</th>
                                <th>Renewal Price</th>
                                <th>Promo Price</th>
                                <th>Promo From</th>
                                <th>Promo Till</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody id="renewal-body">
                            @foreach($tld->tldsRenewalPrices as $renewalPrice)
                                <tr data-id="{{ $renewalPrice->id }}" class="tlds-renewal-prices-{{$renewalPrice->id}}">
                                    <td>
                                        <a href="#" id="renewal-year" data-type="text" data-pk="{{ $tld->id }}"  data-title="Please Enter Year" class="editable editable-click renewal-year">
                                            {{ $renewalPrice->year }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="renewal-price" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Enter Renewal Price" class="editable editable-click renewal-price">
                                            {{ $renewalPrice->renewal_price }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="renewal-promo-price" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Enter Promo Price" class="editable editable-click renewal-promo-price">
                                            {{ $renewalPrice->promo_price }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="renewal-promo-from" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Select Starting Date of Promo Price" class="editable editable-click renewal-promo-from">
                                            {{ $renewalPrice->promo_from }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" id="renewal-promo-to" data-type="text" data-pk="{{ $tld->id }}" data-title="Please Select Ending Date of Promo Price" class="editable editable-click renewal-promo-to">
                                            {{ $renewalPrice->promo_to }}
                                        </a>
                                    </td>

                                    <td><a href="javascript:;" class="renewal-remove-btn">Remove</a> </td>
                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button class="btn btn-primary" id="add-renewal-btn" data-toggle="modal" data-target="#add-renewal-modal">ADD Price</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('domain::partials.add_price_modal')

@endsection

@section('script')
    <script src="{{ asset('adminTheme/vendors/jquery-mockjax/js/jquery.mockjax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script>
        var f = 'bootstrap3';
    </script>
    <script src="{{ asset('adminTheme/vendors/x-editable/js/bootstrap-editable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/x-editable/js/typeahead.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/x-editable/js/typeaheadjs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/x-editable/js/address.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('adminTheme/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminTheme/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script>
        let c = window.location.href.match(/c=inline/i) ? 'inline' : 'popup';
        $.fn.editable.defaults.mode = c === 'inline' ? 'inline' : 'popup';

        $(function() {
            $('#f').val(f);
            $('#c').val(c);


        });
    </script>
        <script src="{{ asset('domain/js/manage-tld-setting.js') }}" type="text/javascript"></script>
@endsection

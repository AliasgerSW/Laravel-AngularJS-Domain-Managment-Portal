@extends('adminTheme.default')

@section('title','Manage Domain')

@section('style')
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet"/>--}}
    <link href="{{ asset('css/tld-detail.css') }}" rel="stylesheet"/>
@endsection

@section('content-header')
    <h1>Manage:</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('admin') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="">Domain</a>
        </li>
        <li class="active">View</li>
    </ol>
@endsection
@section('content')
    <div class="row" ng-app="DSM">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <a href="#tab1" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon1.png') }}">
                            <h5>Overview</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab2" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon3.png') }}">
                            <div class="paid">PAID</div>
                            <h5>DNS</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab3" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon3.png') }}">
                            <div class="paid">PAID</div>
                            <h5>Domain Forwarding</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab4" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon4.png') }}">
                            <div class="paid">PAID</div>
                            <h5>Child Name Server</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab5" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon5.png') }}">
                            <div class="paid">PAID</div>
                            <h5>Name Server</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab6" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon6.png') }}">
                            <div class="free">FREE</div>
                            <h5>Email</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <!--<a href="#tab7" data-toggle="tab"></a>   Use For 7th Tab-->
                        <div class="paddingBtn">
                            <button type="button" class="btn btn-success btn-sm">Button 2</button>
                            <span class="paddingBoth pull-right"><i class="fa fa fa-question-circle"></i></span>
                            <span class="error-text pull-right">9999</span>
                        </div>
                        <div class="paddingBtn">
                            <button type="button" class="btn btn-dark btn-sm">Button 3</button>
                            <span class="paddingBoth pull-right"><i class="fa fa fa-question-circle"></i></span>
                            <span class="error-text-dark pull-right">9999</span>
                        </div>
                        <div class="paddingBtn">
                            <button type="button" class="btn btn-warning btn-sm">Button 4</button>
                            <span class="paddingBoth pull-right"><i class="fa fa fa-question-circle"></i></span>
                            <span class="error-text-warning pull-right">9999</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <a href="#tab8" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon8.png') }}">
                            <div class="paid">PAID</div>
                            <h5>DNSSEC</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab9" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon9.png') }}" style="width:40px !important;">
                            <div class="paid">PAID</div>
                            <h5>Domain Secret</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab10" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon10.png') }}">
                            <div class="paid">PAID</div>
                            <h5>GDPR</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab11" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon11.png') }}">
                            <div class="paid">PAID</div>
                            <h5>Theft Protection</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#tab12" data-toggle="tab" class="link-primary-color">
                        <div class="boximg">
                            <img src="{{ asset('images/tld-detail-icon12.png') }}" style="width:90px !important;">
                            <div class="paid">PAID</div>
                            <h5>Domain Contact</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="panel padding-top">
                <div class="panel-body" style="padding:0px !important">
                    <div id="myTabContent" class="tab-content">

                        <div class="tab-pane fade active in" id="tab1">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Overview
                                    </div>
                                </div>
                                <div class="portlet-body minheight">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab2">
                            <div class="portlet box">
                                <div class="portlet-title primary-color">
                                    <div class="caption text-center"> Manage DNS
                                        <div class="pull-right">
                                            <span class="error-text">9999</span>
                                            <span class="paddingBoth"><i class="fa fa fa-question-circle"></i></span>
                                            <a class="table-btn">Renew</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <ul class="nav nav-pills">
                                                <li class="active"><a href="#inner-tab1" data-toggle="tab">A Records</a>
                                                </li>
                                                <li><a href="#inner-tab2" data-toggle="tab">AAA Records</a></li>
                                                <li><a href="#inner-tab3" data-toggle="tab">MX Records</a></li>
                                                <li><a href="#inner-tab4" data-toggle="tab">CNAME Records</a></li>
                                                <li><a href="#inner-tab5" data-toggle="tab">Ns Records</a></li>
                                                <li><a href="#inner-tab6" data-toggle="tab">TXT Records</a></li>
                                                <li><a href="#inner-tab7" data-toggle="tab">SRV Records</a></li>
                                                <li><a href="#inner-tab8" data-toggle="tab">SOA Records</a></li>
                                            </ul>
                                        </div>

                                        <div class="panel-body">
                                            <div class="tab-content" id="slim1">
                                                <div class="tab-pane active" id="inner-tab1">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">
                                                                    Manage A Record
                                                                    <a class="pull-right table-btn open-modal"
                                                                       data-open="#dns_a_record_add">Add</a>
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>70239173</td>
                                                                    <td>ns1.alongdomainnamefordnsarecordtest.com</td>
                                                                    <td>148.251.67.88</td>
                                                                    <td>Active</td>
                                                                    <td><i class="fa fa-fw fa-angle-down"></i></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>70239173</td>
                                                                    <td>ns1.alongdomainnamefordnsarecordtest.com</td>
                                                                    <td>148.251.67.88</td>
                                                                    <td>Active</td>
                                                                    <td>
                                                                        <a role="button" data-toggle="collapse"
                                                                           data-parent="#accordion" href="#collapseOne"
                                                                           aria-expanded="true"
                                                                           aria-controls="collapseOne">
                                                                            <i class="fa fa-fw fa-angle-down"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" style="padding:0px;">
                                                                        <div id="collapseOne"
                                                                             class="panel-collapse collapse"
                                                                             role="tabpanel"
                                                                             aria-labelledby="headingOne">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <p><strong>Zone Id</strong>
                                                                                            </p>
                                                                                            <p><strong>Record
                                                                                                    Id</strong></p>
                                                                                            <p><strong>Name</strong></p>
                                                                                            <p><strong>Class</strong>
                                                                                            </p>
                                                                                            <p><strong>Type</strong></p>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <p>121321</p>
                                                                                            <p>4645115</p>
                                                                                            <p>fjsdflksdfsd</p>
                                                                                            <p>IN</p>
                                                                                            <p>A</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <p><strong>Status</strong>
                                                                                            </p>
                                                                                            <p><strong>Value</strong>
                                                                                            </p>
                                                                                            <p><strong>TTL</strong></p>
                                                                                            <p><strong>Creation
                                                                                                    Date</strong></p>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <p>Active</p>
                                                                                            <p>4645115</p>
                                                                                            <p>9800000</p>
                                                                                            <p>23-06-18</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <a class="pull-right table-btn-delete">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>70239173</td>
                                                                    <td>ns1.alongdomainnamefordnsarecordtest.com</td>
                                                                    <td>148.251.67.88</td>
                                                                    <td>Active</td>
                                                                    <td>
                                                                        <a role="button" data-toggle="collapse"
                                                                           data-parent="#accordion" href="#collapseTwo"
                                                                           aria-expanded="true"
                                                                           aria-controls="collapseTwo">
                                                                            <i class="fa fa-fw fa-angle-down"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" style="padding:0px;">
                                                                        <div id="collapseTwo"
                                                                             class="panel-collapse collapse"
                                                                             role="tabpanel"
                                                                             aria-labelledby="headingOne">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <p><strong>Zone Id</strong>
                                                                                            </p>
                                                                                            <p><strong>Record
                                                                                                    Id</strong></p>
                                                                                            <p><strong>Name</strong></p>
                                                                                            <p><strong>Class</strong>
                                                                                            </p>
                                                                                            <p><strong>Type</strong></p>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <p>121321</p>
                                                                                            <p>4645115</p>
                                                                                            <p>fjsdflksdfsd</p>
                                                                                            <p>IN</p>
                                                                                            <p>A</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <p><strong>Status</strong>
                                                                                            </p>
                                                                                            <p><strong>Value</strong>
                                                                                            </p>
                                                                                            <p><strong>TTL</strong></p>
                                                                                            <p><strong>Creation
                                                                                                    Date</strong></p>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <p>Active</p>
                                                                                            <p>4645115</p>
                                                                                            <p>9800000</p>
                                                                                            <p>23-06-18</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <a class="pull-right table-btn-delete">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="inner-tab2">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">AAA Record
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>row 1, cell 1</td>
                                                                    <td>row 2, cell 2</td>
                                                                    <td>row 3, cell 3</td>
                                                                    <td>row 4, cell 4</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="inner-tab3">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">MX Record
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>row 1, cell 1</td>
                                                                    <td>row 2, cell 2</td>
                                                                    <td>row 3, cell 3</td>
                                                                    <td>row 4, cell 4</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="inner-tab4">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">CNAME
                                                                    Record
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>row 1, cell 1</td>
                                                                    <td>row 2, cell 2</td>
                                                                    <td>row 3, cell 3</td>
                                                                    <td>row 4, cell 4</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="inner-tab5">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">NS Record
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>row 1, cell 1</td>
                                                                    <td>row 2, cell 2</td>
                                                                    <td>row 3, cell 3</td>
                                                                    <td>row 4, cell 4</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="inner-tab6">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">TXT Record
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>row 1, cell 1</td>
                                                                    <td>row 2, cell 2</td>
                                                                    <td>row 3, cell 3</td>
                                                                    <td>row 4, cell 4</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="inner-tab7">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">SRV Record
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>row 1, cell 1</td>
                                                                    <td>row 2, cell 2</td>
                                                                    <td>row 3, cell 3</td>
                                                                    <td>row 4, cell 4</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="inner-tab8">
                                                    <div class="portlet box default">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-hover">
                                                                <caption class="primary-color text-center">SOA Record
                                                                </caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Record ID</th>
                                                                    <th>Name</th>
                                                                    <th>Destination IP</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>row 1, cell 1</td>
                                                                    <td>row 2, cell 2</td>
                                                                    <td>row 3, cell 3</td>
                                                                    <td>row 4, cell 4</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab3">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Domain Forwarding
                                    </div>
                                </div>
                                <div class="portlet-body minheight" style="color: black;">
                                    @include('domain::domains.services.domainforwarding');
                                </div>
                                <div class="portlet-body">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab4">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Child Name Server
                                    </div>
                                </div>
                                <div class="portlet-body minheight">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab5">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Name Server
                                    </div>
                                </div>
                                <div class="portlet-body minheight">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab6">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Email
                                    </div>
                                </div>
                                <div class="portlet-body minheight">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab7">
                            <h1>Blank</h1>
                        </div>

                        <div class="tab-pane fade" id="tab8">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        DNSSEC
                                    </div>
                                </div>
                                <div class="portlet-body minheight">

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab9">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Domain Secret
                                    </div>
                                </div>
                                <div class="portlet-body minheight" ng-controller="domainSecretController">
                                    <form method="post" ng-submit="saveDomainSecret()" name="domainSecretForm">

                                        <div class="form-group">
                                            <label>Domain Secret</label>
                                            <input type="text" style="display: none;" name="domain_id"
                                                   ng-model="domain_id"/>
                                            <input type="text" class="form-control" id="domain-secret" ng-minlength="6"
                                                   ng-maxlength="12" ng-required="true" ng-model="domain_secret_key"
                                                   name="domain_secret_key" value="" placeholder="Domain Secret"/>
                                            <div class="has-error"
                                                 ng-show="domainSecretForm.domain_secret_key.$invalid"><span
                                                        class="help-block"> @lang('admin.domain.domainsecretkey.error') </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary"
                                                ng-disabled="domainSecretForm.$invalid">Update
                                        </button>
                                        <div class="alert alert-success" ng-show="success_message != ''"><%
                                            success_message %>
                                        </div>
                                        <div class="alert alert-danger" ng-show="error_message != ''"><% error_message
                                            %>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab10">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        GDPR
                                    </div>
                                </div>
                                <div class="portlet-body minheight" ng-controller="gdprController">
                                    <form method="post" ng-submit="saveGdpr()" name="gdprForm">

                                        <div class="form-group">
                                            <label> @lang('admin.domain.gdpr.form.title') </label>
                                            <input type="text" ng-show="false" name="domain_id" ng-model="domain_id"/>
                                            <input type="checkbox" class="" ng-model="gdpr" name="gdpr"
                                                   ng-checked="@if(isset($domain->gdpr_protection) && $domain->gdpr_protection == 1) {{ "true" }} @else {{ "false" }}" @endif />
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <div class="alert alert-success" ng-show="success_message != ''"><%
                                            success_message %>
                                        </div>
                                        <div class="alert alert-danger" ng-show="error_message != ''"><% error_message
                                            %>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab11">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Theft Protection
                                    </div>
                                </div>
                                <div class="portlet-body minheight" ng-controller="theftProtectionController"
                                     style="color: black;">
                                    <form method="post" ng-submit="saveTheftProtection()" name="theftProtectionForm">

                                        <div class="form-group">
                                            <label> @lang('admin.domain.theftprotection.form.title') </label>
                                            <input type="text" ng-show="false" name="domain_id" ng-model="domain_id"/>
                                            <input type="checkbox" class="" ng-model="theftProtection"
                                                   name="theftProtection"
                                                   ng-checked="@if(isset($domain->theft_protection_status) && $domain->theft_protection_status == 1) {{ "true" }} @else {{ "false" }}" @endif />
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <div class="alert alert-success" ng-show="success_message != ''"><%
                                            success_message %>
                                        </div>
                                        <div class="alert alert-danger" ng-show="error_message != ''"><% error_message
                                            %>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab12">
                            <div class="portlet box primary-color">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Domain Contact
                                    </div>
                                </div>
                                <div class="portlet-body minheight">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-fade-in-scale-up" style="display: none;" tabindex="-1" id="dns_a_record_add"
             role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="modalLabelfade">DNS A Records</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Add DNS A Records
                        </p>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="a-record-1">A Record</label>
                                <input type="text" class="form-control" id="a-record-1" placeholder="Enter A Record">
                            </div>
                            <div class="form-group">
                                <label for="a-record-1">A Record</label>
                                <input type="text" class="form-control" id="a-record-1" placeholder="Enter A Record">
                            </div>
                            <div class="form-group">
                                <label for="a-record-1">A Record</label>
                                <input type="text" class="form-control" id="a-record-1" placeholder="Enter A Record">
                            </div>
                            <button type="submit" class="btn btn-primary" ng-submit="savearecord()">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn  btn-primary" data-dismiss="modal">Close me!</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')
    <script>
        jQuery(document).ready(function () {
            jQuery(document).on('click', '.open-modal', function (e) {
                e.preventDefault();
                jQuery(jQuery(this).data('open')).show();
                jQuery(jQuery(this).data('open')).css('opacity', '1');
            });
        });

        //var DSM = angular.module("DSM", []);
        var DSM = angular.module('DSM', ['ui.select', 'ngSanitize'], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        (function (app) {
            "use strict";
            app.controller('domainSecretController', function ($rootScope, $scope, $http) {
                $scope.initializingStates = false;
                $scope.stateslist = [];
                $scope.success_message = '';
                $scope.error_message = '';
                $scope.domain_id = {{ $id }};
                $scope.domain_secret_key = @if(isset($domain->domian_secret_key)) {{ $domain->domian_secret_key }} @else "" @endif;
                $scope.saveDomainSecret = function () {
                    var token = $("input[name='_token']").val();
                    $scope.initializingStates = true;
                    $http({
                        method: "post",
                        url: "{{ route('admin.domains.domain.domainsecret') }}",
                        data: {
                            domain_id: $scope.domain_id,
                            domian_secret_key: $scope.domain_secret_key,
                            _token: token
                        }
                    }).then(function (res) {
                        $scope.initializingStates = false;
                        $scope.stateslist = res.data;
                        if (typeof res.data.success !== 'undefined') {
                            $scope.error_message = '';
                            $scope.success_message = res.data.success.message;
                        }
                        else if (typeof res.data.error.message !== 'undefined') {
                            $scope.error_message = res.data.error.message;
                            $scope.success_message = '';
                        }
                    }, function (err) {
                        $scope.initializingStates = false;
                        $scope.stateslist = {};
                    })

                }

            });

            app.controller('domainForwardingController', function ($rootScope, $scope, $http) {
                $scope.initializingStates = false;
                $scope.stateslist = [];
                $scope.success_message = '';
                $scope.error_message = '';
                $scope.domain_id = {{ $id }};
                $scope.destination_protocol = @if(isset($df->destination_protocol)) '{{ $df->destination_protocol }}'
                @else '{{"http"}}' @endif;
                $scope.destination_url = @if(isset($df->destination_url)) '{{ $df->destination_url }}'
                @else '' @endif;
                $scope.url_masking = @if(isset($df->url_masking)) '{{ $df->url_masking }}'
                @else '0' @endif;
                $scope.source = @if(isset($df->source)) '{{ $df->source }}'
                @else '' @endif;
                $scope.destination_url_regex = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/;
                $scope.source_regex = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/;
                $scope.openModal = function (df) {
                    debugger;
                    alert(df);
                }
                $scope.saveForwardDomainSecret = function () {
                    var token = $("input[name='_token']").val();
                    $scope.initializingStates = true;
                    $http({
                        method: "post",
                        url: "{{ route('admin.domains.domain.domainforwarding') }}",
                        data: {
                            domain_id: $scope.domain_id,
                            destination_protocol: $scope.destination_protocol,
                            destination_url: $scope.destination_url,
                            source: $scope.source,
                            url_masking: $scope.url_masking,
                            _token: token
                        }
                    }).then(function (res) {
                        $scope.initializingStates = false;
                        $scope.stateslist = res.data;
                        if (typeof res.data.success !== 'undefined') {
                            $scope.error_message = '';
                            $scope.success_message = res.data.success.message;
                        }
                        else if (typeof res.data.error.message !== 'undefined') {
                            $scope.error_message = res.data.error.message;
                            $scope.success_message = '';
                        }
                    }, function (err) {
                        $scope.initializingStates = false;
                        $scope.stateslist = {};
                    })
                }

            });

            // GDPR
            app.controller('gdprController', function ($rootScope, $scope, $http) {
                $scope.initializingStates = false;
                $scope.stateslist = [];
                $scope.success_message = '';
                $scope.error_message = '';
                $scope.domain_id = {{ $id }};
                $scope.gdpr = @if(isset($domain->gdpr_protection)) '{{ $domain->gdpr_protection }}'
                @else '{{"0"}}' @endif;
                $scope.saveGdpr = function () {
                    var token = $("input[name='_token']").val();
                    $scope.initializingStates = true;
                    $http({
                        method: "post",
                        url: "{{ route('admin.domains.domain.gdprprotection') }}",
                        data: {
                            domain_id: $scope.domain_id,
                            status: $scope.gdpr ? 1 : 0,
                            _token: token
                        }
                    }).then(function (res) {
                        $scope.initializingStates = false;
                        $scope.stateslist = res.data;
                        if (typeof res.data.success !== 'undefined') {
                            $scope.error_message = '';
                            $scope.success_message = res.data.success.message;
                        }
                        else if (typeof res.data.error.message !== 'undefined') {
                            $scope.error_message = res.data.error.message;
                            $scope.success_message = '';
                        }
                    }, function (err) {
                        $scope.initializingStates = false;
                        $scope.stateslist = {};
                    });
                }

            });


            // Theft Protection
            app.controller('theftProtectionController', function ($rootScope, $scope, $http) {
                $scope.initializingStates = false;
                $scope.stateslist = [];
                $scope.success_message = '';
                $scope.error_message = '';
                $scope.domain_id = {{ $id }};
                $scope.gdpr = @if(isset($domain->theft_protection_status)) '{{ $domain->theft_protection_status }}'
                @else '{{"0"}}' @endif;
                $scope.saveTheftProtection = function () {
                    var token = $("input[name='_token']").val();
                    $scope.initializingStates = true;
                    $http({
                        method: "post",
                        url: "{{ route('admin.domains.domain.theftprotection') }}",
                        data: {
                            domain_id: $scope.domain_id,
                            status: $scope.theftProtection ? 1 : 0,
                            _token: token
                        }
                    }).then(function (res) {
                        $scope.initializingStates = false;
                        $scope.stateslist = res.data;
                        if (typeof res.data.success !== 'undefined') {
                            $scope.error_message = '';
                            $scope.success_message = res.data.success.message;
                        }
                        else if (typeof res.data.error.message !== 'undefined') {
                            $scope.error_message = res.data.error.message;
                            $scope.success_message = '';
                        }
                    }, function (err) {
                        $scope.initializingStates = false;
                        $scope.stateslist = {};
                    });
                }

            });

        })(DSM);


    </script>

@endsection
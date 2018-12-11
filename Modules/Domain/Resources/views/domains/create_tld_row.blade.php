@extends('adminTheme.default')

@section('title','Manage Tlds')

@section('style')
    <link href="{{ asset('adminTheme/css/pages/sortable_list.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/iCheck/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/iCheck/css/line/line.css') }}">
@endsection

@section('content-header')
    <h1>Manage Tlds</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('admin') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#">Tlds</a>
        </li>
        <li class="active">View</li>
    </ol>
    @include('errors.list')
@endsection

@section('content')
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="livicon" data-name="medal" data-size="16" data-loop ="true" data-c="#fff" data-hc="white"></i>
                    TLDS
                </h4>
            </div>
            <div class="panel-body">

                <div class="col-md-8 col-md-offset-2">
                    <form action="{{ route('admin.domains.tld.store-tld-row') }}" method="post">
                        {!! csrf_field()  !!}
                        <div class="form-group">
                            <label for="registrar" class="control-label">Choose Registrar:</label>
                            <select name="registrar" class="form-control" id="registrar">
                                <option value="OpenSRS">Open SRS</option>
                                <option value="ResellerClub">Reseller Club</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tld-name" class="control-label">Name:</label>
                            <input type="text" class="form-control" placeholder=".com" name="name" id="tld-name" />
                        </div>

                        <div class="form-group">
                            <p>Sale Status:</p>
                            <input type="radio" name="is_active_for_sale" class="line" value="1" checked/>
                            <label>Active For Sale</label>
                            <input type="radio" name="is_active_for_sale" class="line" value="0" />
                            <label>InActive For Sale</label>
                        </div>

                        <div class="form-group">
                            <label for="feature" class="control-label">Feature:</label>
                            <select name="feature" class="form-control" id="feature">
                                <option value="Popular">Popular</option>
                                <option value="Regular">Regular</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cost_price" class="control-label">Cost Price:</label>
                            <input type="text" class="form-control" placeholder="Cost Price" name="cost_price" id="cost_price" />
                        </div>

                        <div class="form-group">
                            <label for="min_purchase_limit" class="control-label">Min Purchase Limit:</label>
                            <input type="number" class="form-control" placeholder="Min Purchase Limit" name="min_purchase_limit" id="min_purchase_limit" min="1" />
                        </div>

                        <div class="form-group">
                            <label for="max_purchase_limit" class="control-label">Max Purchase Limit:</label>
                            <input type="number" class="form-control" placeholder="Max Purchase Limit" name="max_purchase_limit" id="max_purchase_limit" min="1" />
                        </div>

                        <div class="form-group">
                            <label for="min_renewal_limit" class="control-label">Min Renewal Limit:</label>
                            <input type="number" class="form-control" placeholder="Min Renewal Limit" name="min_renewal_limit" id="min_renewal_limit" min="1" />
                        </div>

                        <div class="form-group">
                            <label for="max_renewal_limit" class="control-label">Max Renewal Limit:</label>
                            <input type="number" class="form-control" placeholder="Max Renewal Limit" name="max_renewal_limit" id="max_renewal_limit" min="1" />
                        </div>

                        <div class="form-group">
                            <label for="max_cancellation_days" class="control-label">Max Cancellation Days:</label>
                            <input type="number" class="form-control" placeholder="Max Cancellation Days" name="max_cancellation_days" id="max_cancellation_days" min="1" />
                        </div>

                        <div class="form-group">
                            <label for="min_renewal_time" class="control-label">Min Renewal Time:</label>
                            <input type="number" class="form-control" placeholder="Min Renewal Time" name="min_renewal_time" id="min_renewal_time" />
                        </div>

                        <div class="form-group">
                            <label for="grace_period" class="control-label">Grace Period:</label>
                            <input type="number" class="form-control" placeholder="Grace Period" name="grace_period" id="grace_period" />
                        </div>

                        <div class="form-group">
                            <label for="restore_period" class="control-label">Restore Period:</label>
                            <input type="number" class="form-control" placeholder="Restore Period" name="restore_period" id="restore_period" />
                        </div>

                        <div class="form-group">
                            <label for="restore_price" class="control-label">Restore Price:</label>
                            <input type="text" class="form-control" placeholder="Restore Price" name="restore_price" id="restore_price" />
                        </div>

                        <div class="form-group">
                            <label for="bulk_price_limit" class="control-label">Bulk Price Limit:</label>
                            <input type="text" class="form-control" placeholder="Bulk Price Limit" name="bulk_price_limit" id="bulk_price_limit" />
                        </div>

                        <div class="form-group">
                            <label for="transfer_price" class="control-label">Transfer Price:</label>
                            <input type="text" class="form-control" placeholder="Transfer Price" name="transfer_price" id="transfer_price" />
                        </div>

                        <div class="form-group">
                            <label for="suggest_group" class="control-label">Suggest Group:</label>
                            <select name="suggest_group" class="form-control" id="suggest_group">
                                <option value="none">None</option>
                                <option value="promo">Promo</option>
                                <option value="popular">Popular</option>
                                <option value="both">Both</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="continents" class="control-label">Continents:</label>
                            <select name="continents[]" class="form-control" id="continents" multiple>
                                @foreach($continents as $continent)
                                    <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tld_groups" class="control-label">Tld Groups:</label>
                            <select name="tld_groups[]" class="form-control" id="tld_groups" multiple>
                                @foreach($tld_groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="sequence" value="1" />
                        <div class="form-group pull-right">
                            <input type="submit" value="Save" class="btn  btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

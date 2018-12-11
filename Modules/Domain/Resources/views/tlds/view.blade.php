@extends('adminTheme.default')

@section('title', __('admin.general.manage').' '.__('admin.tld.title'))

@section('style')
    <link href="{{ asset('adminTheme/css/pages/sortable_list.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('adminTheme/css/customTld.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/iCheck/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/iCheck/css/line/line.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/switchery/css/switchery.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('adminTheme/vendors/bootstrap-switch/css/bootstrap-switch.css') }}">
@endsection

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.tld.title')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('admin') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> @lang('admin.general.dashboard')
            </a>
        </li>
        <li class="active">
            @lang('admin.tld.title')
        </li>
    </ol>
    @include('errors.list')
@endsection

@section('content')


    <div class="row tld-top">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label">@lang('admin.general.total') @lang('admin.tld.title')</div>
                        <div class="ltd-top-box-value">{{$tld_data['total_tlds']}}</div>
                    </div>
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label">@lang('admin.tld.resellerclub')</div>
                        <div class="ltd-top-box-value">{{$tld_data['Reseller_tlds']}}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label">@lang('admin.general.active') @lang('admin.tld.title')</div>
                        <div class="ltd-top-box-value">{{$tld_data['total_active_tlds']}}</div>
                    </div>
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label">@lang('admin.tld.opensrs')</div>
                        <div class="ltd-top-box-value">{{$tld_data['OpenSRS_tlds']}}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label">@lang('admin.tld.promocode') @lang('admin.tld.title')</div>
                        <div class="ltd-top-box-value">{{$tld_data['promo_tlds']}}</div>
                    </div>
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label ltd-top-box-label-red">@lang('admin.general.actionreq')</div>
                        <div class="ltd-top-box-value">{{$tld_data['action_required']}}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label">@lang('admin.tld.bulk') @lang('admin.tld.title')</div>
                        <div class="ltd-top-box-value">{{$tld_data['bulk__tlds']}}</div>
                    </div>
                    <div class="ltd-top-box">
                        <div class="ltd-top-box-label">@lang('admin.general.lastUpdate')</div>
                        <div class="ltd-top-box-value ltd-top-box-value-date">
                            @if(isset($tld_data['last_updated_tld']->updated_at))
                                {{date('m/d/Y H:i', strtotime($tld_data['last_updated_tld']->updated_at->toDayDateTimeString()))}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 remove-right-padding remove-left-padding">
            <div class="row remove-left-padding">
                <div class="col-md-4">
                    <div class="ltd-top-box ltd-top-box-cron-ht">
                        <div class="ltd-top-box-label ltd-top-box-cron"><i class="fa fa-cloud-download"></i>
                            @lang('admin.general.cronJob') @lang('admin.general.status')
                        </div>
                        <div class="ltd-top-box-value">@lang('admin.general.noUpdate')</div>
                    </div>
                </div>
                <div class="col-md-7 col-md-offset-1">
                    <div class="text-right">
                        <form action="{{ route('tlds.pull') }}" method="get" style="display: inline-block;">
                            <button type="submit "class="btn btn-success btn-gr"><i class="fa fa-star"></i> @lang('admin.tld.pull') @lang('admin.tld.title')</button>
                        </form>
                        <a href="{{route('admin.domains.tld.details')}}" class="btn btn-success btn-gr"><i class="fa fa-plus"></i> @lang('admin.general.create') @lang('admin.tld.title')</a>
                        <br/>
                        <button class="btn btn-warning btn-cron-update"><i class="fa fa-download"></i> @lang('admin.general.cronJob') @lang('admin.general.update')
                        </button>
                    </div>
                    <div class="btn-col">
                        <form action="">
                            <div class="form-group input-group">
                                <input type="text" class="form-control" placeholder="@lang('admin.general.search')..." name="search"
                                       value="{{ request()->get('search') }}">
                                <span class="input-group-btn">
								<button class="btn btn-primary" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row tld-list">
        <div class="col-md-12">
            <div class="panel">
                <div id="sortTrue" class="panel-body list-group">

                    @if(isset($tld_data['all_tlds']) && !empty($tld_data['all_tlds']))
                    @foreach($tld_data['all_tlds'] as $tld)
                        <?php
                        $tld_price_key = array_search($tld->id, array_column($tld_data['tlds_prices'], 'tld_id'));
                        $tlds_renewal_prices_key = array_search($tld->id, array_column($tld_data['tlds_renewal_prices'], 'tld_id'));
                        $promo_from = '';
                        $promo_to = '';
                        $regular_price = '';
                        $renewal_price = '';
                        $bulk_price = '';
                        $promo_price = '';

                        if(isset($tld_data['least_promo_prices'][$tld->id]))
                            $promo_price = $tld_data['least_promo_prices'][$tld->id][$tld->id]['promo_price'];

                        if(isset($tld_data['least_renewal_prices'][$tld->id]))
                            $renewal_price = $tld_data['least_renewal_prices'][$tld->id][$tld->id]['promo_price'];

                        if(isset($tld_data['least_regular_price'][$tld->id]))
                            $regular_price = $tld_data['least_regular_price'][$tld->id][$tld->id]['regular_price'];

                        if(isset($tld_data['least_bulk_price'][$tld->id]))
                            $bulk_price = $tld_data['least_bulk_price'][$tld->id][$tld->id]['bulk_price'];

                        if(isset($tld_data['least_price_promo_from'][$tld->id]))
                            $promo_from= date('Y-m-d H:i:s', strtotime($tld_data['least_price_promo_from'][$tld->id]));

                        if(isset($tld_data['least_price_promo_to'][$tld->id]))
                            $promo_to= date('Y-m-d H:i:s', strtotime($tld_data['least_price_promo_to'][$tld->id]));

                        if (empty($tld_price_key) === true) {
                            if ($tld_price_key === 0 || $tld_price_key === '0') {
                            }
                        } else {
                            if(($tld_price_key != '')){
                            }
                        }
                        ?>
                    <div class="col-md-6 list-group-item item" data-id="{{$tld->id}}">
                        <div class="fancy-collapse-panel">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="portlet box primary-tld">
                                    <div class="portlet-title">
                                        <div class="row panel-title">
                                            <div class="col-md-3">
                                                <div class="caption">
                                                    @if($tld->force_fully_active == 1 && $tld->is_active_for_sale == 0)
                                                        <input type="checkbox" class="js-switch active_inactive_for_sale" act_req="1" mtld="{{$tld->id}}" checked/> {{$tld->name}}
                                                    @elseif($tld->force_fully_active == 1 && $tld->is_active_for_sale == 1 &&
                                                    in_array($tld->id,$tld_data['action_required_tlds']))
                                                        <input type="checkbox" class="js-switch active_inactive_for_sale" act_req="1" mtld="{{$tld->id}}" checked /> {{$tld->name}}
                                                    @elseif(in_array($tld->id,$tld_data['action_required_tlds']))
                                                        <input type="checkbox" class="js-switch active_inactive_for_sale" act_req="1" mtld="{{$tld->id}}" /> {{$tld->name}}
                                                    @elseif($tld->is_active_for_sale == 1)
                                                        <input type="checkbox" class="js-switch active_inactive_for_sale" act_req="0" mtld="{{$tld->id}}" checked/> {{$tld->name}}
                                                    @else
                                                        <input type="checkbox" class="js-switch active_inactive_for_sale" act_req="0" mtld="{{$tld->id}}" /> {{$tld->name}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label for="" class="label label-warning mtld_seq_id">{{$tld->sequence}}</label>
                                            </div>
                                            <div class="col-md-3 col-md-offset-1">
                                                @if($tld->registrar == 'OpenSRS')
                                                    <input type="checkbox" data-on-color="info" data-off-color="success" class="registrar_type" registrar_mtld="{{$tld->id}}"
                                                       data-on-text="OpenSRS" data-label-text="API" registrar_mtld_val="{{$tld->registrar}}"
                                                       data-off-text="ResellerClub" name="my-checkbox" data-size="mini"
                                                       checked>
                                                @elseif($tld->registrar == 'ResellerClub')
                                                <input type="checkbox" data-on-color="success" data-off-color="info" class="registrar_type" registrar_mtld="{{$tld->id}}"
                                                       data-on-text="ResellerClub" data-label-text="API" registrar_mtld_val="{{$tld->registrar}}"
                                                       data-off-text="OpenSRS" name="my-checkbox" data-size="mini"
                                                       checked>
                                                @endif

                                            </div>
                                            <div class="col-md-3 text-right">
                                                <a href="/admin/domains/tld/details/{{$tld->id}}" class="btn btn-primary btn-tld-list-manage">
                                                    @lang('admin.general.manage')
                                                </a>
                                                <a data-toggle="collapse" class="collapsed color-white" data-parent="#accordion" href="#{{$tld->id}}"
                                                   aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="fa fa fa-chevron-down josh-accordion"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="{{$tld->id}}" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="portlet-body" id="collapseTld_1">
                                            <div class="table-scrollable">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.general.min') @lang('admin.tld.register')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.general.max') @lang('admin.tld.register')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.general.min') @lang('admin.tld.renewal')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.general.max') @lang('admin.tld.renewal')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.tld.bulkEligible')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.tld.promocode') @lang('admin.general.status')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>@if(isset($tld->min_purchase_limit)) {{$tld->min_purchase_limit}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>@if(isset($tld->max_purchase_limit)) {{$tld->max_purchase_limit}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>@if(isset($tld->min_renewal_limit)) {{$tld->min_renewal_limit}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>@if(isset($tld->max_renewal_limit)) {{$tld->max_renewal_limit}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>@if(isset($tld->bulk_price_limit)) {{$tld->bulk_price_limit}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>
                                                            <?php
                                                                $current_date_time = date('Y-m-d H:i:s');
                                                                if (isset($promo_from)) {
                                                                    $promo_from_for_period = date('Y-m-d H:i:s', strtotime($promo_from));
                                                                    $promo_to_for_period = date('Y-m-d H:i:s', strtotime($promo_to));
                                                                    if (($current_date_time > $promo_from_for_period) && ($current_date_time < $promo_to_for_period)) {
                                                                        ?><span class="label label-sm label-success">@lang('admin.general.active')</span><?php
                                                                    } else {
                                                                ?><span class="label label-sm label-danger">@lang('admin.general.inactive')</span><?php
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <thead>
                                                    <tr>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.tld.cancel') @lang('admin.tld.period')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.tld.renewal') @lang('admin.tld.period')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.tld.grace') @lang('admin.tld.period')</th>
                                                        <th><i class="fa fa-clock-o"></i> @lang('admin.tld.restore') @lang('admin.tld.period')</th>
                                                        <th colspan="2"><i class="fa fa-clock-o"></i> @lang('admin.tld.promocode') @lang('admin.tld.period')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>@if(isset($tld->max_cancellation_days)) {{$tld->max_cancellation_days}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>@if(isset($tld->min_renewal_time)) {{$tld->min_renewal_time}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>@if(isset($tld->grace_period)) {{$tld->grace_period}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td>@if(isset($tld->restore_period)) {{$tld->restore_period}} @lang('admin.general.year_s') @else - @endif</td>
                                                        <td colspan="2">
                                                            <span class="text-success">
                                                                @if(!empty($promo_from)){{date('m/d/Y', strtotime($promo_from))}}@endif
                                                            </span> -
                                                            <span class="text-danger">
                                                                @if(!empty($promo_to)){{date('m/d/Y', strtotime($promo_to))}}@endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <thead>
                                                    <tr>
                                                        <th><i class="fa fa-money"></i> @lang('admin.tld.cost') @lang('admin.general.price')</th>
                                                        <th><i class="fa fa-money"></i> @lang('admin.tld.register') @lang('admin.general.price')</th>
                                                        <th><i class="fa fa-money"></i> @lang('admin.tld.renewal') @lang('admin.general.price')</th>
                                                        <th><i class="fa fa-money"></i> @lang('admin.tld.transfer') @lang('admin.general.price')</th>
                                                        <th><i class="fa fa-money"></i> @lang('admin.tld.bulk') @lang('admin.general.price')</th>
                                                        <th><i class="fa fa-money"></i> @lang('admin.tld.promocode') @lang('admin.general.price')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            @if(isset($tld->cost_price))
                                                                @if(in_array($tld->id,$tld_data['action_required_tlds']))
                                                                    <span class="label label-sm label-danger">
                                                                        {{$tld->cost_price}}
                                                                    </span>
                                                                @else
                                                                    <span class="label label-sm label-info">
                                                                        {{$tld->cost_price}}
                                                                    </span>
                                                                @endif
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($regular_price)) {{$regular_price}} @else - @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($renewal_price)) {{$renewal_price}} @else - @endif
                                                        </td>
                                                        <td>@if(isset($tld->transfer_price)) {{$tld->transfer_price}} @else - @endif</td>
                                                        <td>
                                                            @if(!empty($bulk_price)) {{$bulk_price}} @else - @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($promo_price)) {{$promo_price}} @else - @endif
                                                        </td>
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
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br/>

    <!-- Modal -->
    <div class="modal fade" id="confirm_registrar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('admin.general.confirm')</h4>
                </div>
                <div class="modal-body">
                    @lang('admin.tld.changeRegistrarConfirm')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin.general.cancel')</button>
                    <button type="button" class="btn btn-primary update_registrar_btn">@lang('admin.general.yes')</button>
                </div>
            </div>
        </div>
    </div>

    @include('domain::partials.add_tld_modal')
@endsection

@section('script')

    <script src="{{ asset('adminTheme/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminTheme/vendors/switchery/js/switchery.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('adminTheme/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script src="{{ asset('adminTheme/vendors/Sortable/js/Sortable.js') }}" type="text/javascript"></script>

    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        var registrat_tld_id = 0;
        var registrar_mtld_val = 0;

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                size: 'small',
                color: 'rgb(1, 188, 140)'
            });
        });

        $("[name='my-checkbox']").bootstrapSwitch({
            onSwitchChange: function(e, data) {
                registrat_tld_id = $(this).attr('registrar_mtld');
                registrar_mtld_val = $(this).attr('registrar_mtld_val');
                $(this).bootstrapSwitch('state', !data, true);
                $('#confirm_registrar_modal').modal();
            }
        });

        $ ("#confirm_registrar_modal .update_registrar_btn").click(function() {
            var new_registrar_val = 'ResellerClub';
            if (registrar_mtld_val == 'OpenSRS') {
                new_registrar_val = 'ResellerClub';
            } else {
                new_registrar_val = 'OpenSRS';
            }

            $.ajax({
                url: "{{ route('admin.domains.tld.change-registrar') }}",
                method: 'POST',
                data: {tld_id:registrat_tld_id, registrar:new_registrar_val, _token: '{{csrf_token()}}' },
                success: function(data) {
                    $("[registrar_mtld="+registrat_tld_id+"]").bootstrapSwitch('toggleState', true);
                    $('#confirm_registrar_modal').modal('hide');
                    swal('',"Registrar updated successfully.", "success");
                }
            });
        });
        $ ("#confirm_force_enable_tld .force_fully_enable_tld").click(function() {
            var new_registrar_val = 'ResellerClub';
            if (registrar_mtld_val == 'OpenSRS') {
                new_registrar_val = 'ResellerClub';
            } else {
                new_registrar_val = 'OpenSRS';
            }

            $.ajax({
                url: "{{ route('admin.domains.tld.change-registrar') }}",
                method: 'POST',
                data: {tld_id:registrat_tld_id, registrar:new_registrar_val, _token: '{{csrf_token()}}' },
                success: function(data) {
                    $("[registrar_mtld="+registrat_tld_id+"]").bootstrapSwitch('toggleState', true);
                    $('#confirm_registrar_modal').modal('hide');
                    swal('',"Registrar updated successfully.", "success");
                }
            });
        });

        $('input.line').each(function () {
            var self = $(this),
                label = self.next(),
                label_text = label.text();

            label.remove();
            self.iCheck({
                checkboxClass: 'icheckbox_line-red',
                radioClass: 'iradio_line-red',
                increaseArea: '20%',
                insert: '<div class="icheck_line-icon"></div>' + label_text
            });
        });

        var foo = document.getElementById("sortTrue");
        Sortable.create(foo, {
            group: "words",
            animation: 150,
            dataIdAttr: 'data-id',
            draggable: '.item',
            store: {
                get: function (sortable) {
                    var order = localStorage.getItem(sortable.options.group);
                    return order ? order.split('|') : [];
                },
                set: function (sortable) {
                    var order = sortable.toArray();
                    $.ajax({
                        url: "{{ route('admin.domains.tld.tld-change-sequence') }}",
                        method: 'POST',
                        data: {order:order, _token: '{{csrf_token()}}' },
                        success: function(data) {
                            var cnt = 1;
                            $('.mtld_seq_id').each(function(i, obj) {
                                $(this).html(cnt);
                                cnt++;
                            });
                        }
                    });
                    $('.visuaplayoutCol02').attr('value', order);
                }
            },
            onEnd: function (/**Event*/evt) {
                $('.visuaplayoutCol01').attr('value', $('.visuaplayoutCol01').attr('value') + ',' + evt.item.dataset.id);
            },
            onAdd: function (/**Event*/evt) {
                var itemEl = evt.item;  // dragged HTMLElement
            },
        });

        $(document).ready(function(){
            $('.josh-accordion').click(function(){
                if ($(this).hasClass('fa-chevron-up')){
                    $(this).removeClass('fa-chevron-up');
                    $(this).addClass('fa-chevron-down');
                } else {
                    $(this).removeClass('fa-chevron-down');
                    $(this).addClass('fa-chevron-up');
                }
            });

            /*
            * Enable - Disable TLD for sale.
            * */
            $('.active_inactive_for_sale').change(function () {
                var tld_td = $(this).attr('mtld');
                var act_req = $(this).attr('act_req');
                if (act_req == 1) {
                    if($(this).prop('checked')) {/* checked */
                        if (confirm('@lang('admin.tld.confirm_force_enable_tld') \n @lang('admin.tld.still_want_to_enable_tld')')) {
                            $.ajax({
                                url: "{{ route('admin.domains.tld.tld-active-force-fully') }}",
                                method: 'POST',
                                data: {
                                    tld_id: tld_td,
                                    is_active_for_sale: 1,
                                    force_fully_active: 1,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function (data) {
                                    swal("@lang('admin.general.activated')!", "@lang('admin.tld.activatedMessage')", "success");
                                }
                            });
                        }
                    } else {
                        $.ajax({
                            url: "{{ route('admin.domains.tld.tld-active-force-fully') }}",
                            method: 'POST',
                            data: {
                                tld_id: tld_td,
                                is_active_for_sale: 0,
                                force_fully_active: 0,
                                _token: '{{csrf_token()}}'
                            },
                            success: function (data) {
                                swal("@lang('admin.general.inactivated')", "@lang('admin.tld.inactivatedMessage')", "success");
                            }
                        });
                    }
                } else {
                    var active_inactive = 0;
                    if($(this).prop('checked')){/* checked */

                        active_inactive = 1;
                    } else {/* un-checked */
                        active_inactive = 0;
                    }

                    $.ajax({
                        url: "{{ route('admin.domains.tld.tld-active-inactive-for-sale') }}",
                        method: 'POST',
                        data: {tld_id:tld_td, is_active_for_sale:active_inactive,force_fully_active:0, _token: '{{csrf_token()}}' },
                        success: function(data) {
                            if(active_inactive == 0)
                                swal("@lang('admin.general.inactivated')", "@lang('admin.tld.inactivatedMessage')", "success");
                            else
                                swal("@lang('admin.general.activated')!", "@lang('admin.tld.activatedMessage')", "success");
                        }
                    });
                }

            });
        })
    </script>
@endsection
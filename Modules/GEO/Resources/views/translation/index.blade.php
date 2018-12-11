@extends('adminTheme.default')

@section('title', __('admin.general.manage').' '.__('admin.geo.translation'))

@section('style')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/buttons.bootstrap.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/colReorder.bootstrap.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/dataTables.bootstrap.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/rowReorder.bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/buttons.bootstrap.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/scroller.bootstrap.css') }}" />
	<link href="{{ asset('adminTheme/vendors/x-editable/css/bootstrap-editable.css') }}" type="text/css" rel="stylesheet" />
	<style>
		.editable-input textarea{
			width: 300px !important;
			height: 90px;
		}
		.dataTables_wrapper{
			margin-top:20px;
		}
	</style>
@endsection

@section('content-header')
	<h1>@lang('admin.general.manage') @lang('admin.geo.translation')</h1>
	<ol class="breadcrumb">
		<li>
			<a href="#">
				<i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
			</a>
		</li>
		<li>
			<a href="#"> @lang('admin.geo')</a>
		</li>
		<li class="active"> @lang('admin.geo.translation')</li>
	</ol>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box primary">
				<div class="portlet-title">
					<div class="caption">
						<i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.managedata',['name'=> __('admin.geo.translation')])
					</div>
				</div>
				<div class="portlet-body">

					<div class="row">
						<div class="col-md-5">

						</div>
						<div class="col-md-7">
							<div class="pull-right">
							<a class="btn btn-success btn-margin-bt" href="{{ route('translations.create') }}"><i class="fa fa-fw fa-plus"></i> @lang('admin.general.create') @lang('admin.geo.translation')</a>
							<a class="btn btn-warning btn-margin-bt" href="{{ route('translations.export') }}"><i class="fa fa-fw fa-download"></i> @lang('admin.general.export')</a>
							<a class="btn btn-info btn-margin-bt" href="{{ route('translations.import') }}"><i class="fa fa-fw fa-file-excel-o"></i> @lang('admin.general.import')</a>
							</div>
						</div>

						<div class="col-md-12">
							<div class="table-scrollable">
								<table class="table table-hover table-bordered">
									<thead>
									<tr>
										<th>Key</th>
										@if($languages->count() > 0)
											@foreach($languages as $language)
												<th>{{ $language->name_english }}({{ $language->code }})</th>
											@endforeach
										@endif
										<th width="80px;">@lang('admin.general.action')</th>
									</tr>
									</thead>
									<tbody>
										@if($columnsCount > 0)
											@foreach($columns[0] as $columnKey => $columnValue)
												<tr>
													<td><a href="#" class="translate-key" data-title="Enter Key" data-type="text" data-pk="{{ $columnKey }}" data-url="{{ route('translation.update.json.key') }}">{{ $columnKey }}</a></td>
													@for($i=1; $i<=$columnsCount; ++$i)
													<td><a href="#" data-title="Enter Translate" class="translate" data-code="{{ $columns[$i]['lang'] }}" data-type="textarea" data-pk="{{ $columnKey }}" data-url="{{ route('translation.update.json') }}">{{ isset($columns[$i]['data'][$columnKey]) ? $columns[$i]['data'][$columnKey] : '' }}</a></td>
													@endfor
													<td><button data-action="{{ route('translations.destroy', $columnKey) }}" class="btn btn-danger btn-xs remove-key"><i class="fa fa-fw fa-trash-o"></i></button></td>
												</tr>
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
				    </div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/jquery.dataTables.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/jeditable/js/jquery.jeditable.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/dataTables.buttons.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/dataTables.colReorder.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/dataTables.responsive.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/dataTables.rowReorder.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/buttons.colVis.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/buttons.html5.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/buttons.print.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/buttons.bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/pdfmake.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/vfs_fonts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/dataTables.scroller.js') }}"></script>
     <script src="{{ asset('adminTheme/vendors/x-editable/js/bootstrap-editable.js') }}" type="text/javascript"></script>
	<script>

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).ready(function() {

            var table = $('.table').DataTable({
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    loadTranslateEditable();
                    loadTranslateKeyEditable();
                }
            });

            loadTranslateEditable();
            loadTranslateKeyEditable();

            function loadTranslateEditable(){
                $('.translate').editable({
                    params: function(params) {
                        // add additional params from data-attributes of trigger element
                        params.code = $(this).editable().data('code');
                        return params;
                    },
                    success: function(response, newValue) {
                        toastr.success("Translate updated successfully.", "Alert");
                    }
                });
			}

			function loadTranslateKeyEditable(){
                $('.translate-key').editable({
                    success: function(response, newValue) {
                        toastr.success("Translate Key updated successfully.", "Alert");
                    },
                    validate: function(value) {
                        if($.trim(value) == '') {
                            return 'Key is required';
                        }
                    }
                });
			}

			$('body').on('click', '.remove-key', function(){
			    var cObj = $(this);

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this item!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55  ",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: cObj.data('action'),
                        method: 'DELETE',
                        success: function(data) {
                            cObj.parents("tr").remove();
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        }
                    });

                });
			});
		});
	</script>
@endsection

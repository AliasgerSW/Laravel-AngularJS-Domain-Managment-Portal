@extends('adminTheme.default')

@section('title', __('admin.general.manage').' '.__('admin.geo.city'))

@section('content-header')
	<h1>@lang('admin.general.manage') @lang('admin.geo.city')</h1>
	<ol class="breadcrumb">
		<li>
			<a href="#">
				<i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
			</a>
		</li>
		<li>
			<a href="#"> @lang('admin.geo')</a>
		</li>
		<li class="active"> @lang('admin.geo.city')</li>
	</ol>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box primary">
				<div class="portlet-title">
					<div class="caption">
						<i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.managedata',['name'=> __('admin.geo.city')])
					</div>
				</div>
				<div class="portlet-body">

					<div class="row">
						<div class="col-md-5">
							<form action="{{ route('cities.index') }}">
								<div class="form-group input-group">
									<input type="text" class="form-control" placeholder="{{ __('admin.general.search') }}..." name="search" value="{{ request()->get('search') }}">
									<span class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</span>
								</div>
							</form>
						</div>
						<div class="col-md-7">
							<div class="pull-right">
							<a class="btn btn-success btn-margin-bt" href="{{ route('cities.create') }}"><i class="fa fa-fw fa-plus"></i> @lang('admin.general.create') @lang('admin.geo.city')</a>
							<a class="btn btn-warning btn-margin-bt" href="{{ route('cities.export') }}"><i class="fa fa-fw fa-download"></i> @lang('admin.general.export')</a>
							<a class="btn btn-info btn-margin-bt" href="{{ route('cities.import') }}"><i class="fa fa-fw fa-file-excel-o"></i> @lang('admin.general.import')</a>
							</div>
						</div>

						<div class="col-md-12">
							<div class="table-scrollable">
								<table class="table table-hover table-bordered">
									<thead>
									<tr>
										<th>#</th>
										<th>@lang('admin.geo.city.country')</th>
										<th>@lang('admin.geo.city.state')</th>
										<th>@lang('admin.geo.city.name')</th>
										<th width="190px">@lang('admin.general.action')</th>
									</tr>
									</thead>
									<tbody>
									@if($cities->count() > 0)
										@foreach($cities as $city)
											<tr>
												<td>{{ $city->id }}</td>
												<td>{{ $city->country->name }}</td>
												<td>{{ $city->state->name }}</td>
												<td>{{ $city->name }}</td>
												<td>
													<form action="{{ route('cities.destroy', $city->id)  }}" method="POST">
														<a href="{{ route('cities.show', $city->id)  }}" class="btn btn-info" data-toggle="tooltip" title="View"><i class="fa fa-fw fa-eye"></i></a>
														<a href="{{ route('cities.edit', $city->id)  }}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
														@method('DELETE')
														@csrf
														<button type="submit" class="btn btn-danger remove-item" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash-o"></i></button>
													</form>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="8" class="text-center">@lang('admin.general.nodata',['name'=> __('admin.geo.city')]).</td>
										</tr>
									@endif
									</tbody>
								</table>
								{{ $cities->links() }}
							</div>
				    </div>
				</div>
			</div>
		</div>
	</div>
@stop
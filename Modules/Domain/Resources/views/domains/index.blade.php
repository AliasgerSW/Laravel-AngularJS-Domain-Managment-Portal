@extends('adminTheme.default')

@section('title', __('admin.general.manage').' Domain')

@section('content-header')
	<h1>@lang('admin.general.manage') Domain</h1>
	<ol class="breadcrumb">
		<li>
			<a href="#">
				<i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
			</a>
		</li>
		<li class="active"> Domain</li>
	</ol>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box primary">
				<div class="portlet-title">
					<div class="caption">
						<i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.managedata',['name'=> 'Domain'])
					</div>
				</div>
				<div class="portlet-body">

					<div class="row">
						<div class="col-md-5">

						</div>
						<div class="col-md-5 col-md-offset-2">
							<div class="pull-right">
								<form action="{{ route('countries.index') }}">
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
						</div>

						<div class="col-md-12">
							<div class="table-scrollable">
								<table class="table table-hover table-bordered">
									<thead>
									<tr>
										<th width="60px">#</th>
										<th>Name</th>
										<th width="190px">@lang('admin.general.action')</th>
									</tr>
									</thead>
									<tbody>
									@if($domains->count() > 0)
										@foreach($domains as $domain)
											<tr>
												<td>{{ $domain->id }}</td>
												<td>{{ $domain->domain_name }}</td>
												<td>
													<form action="{{ route('domain.destroy', $domain->id)  }}" method="POST">
														<a href="{{ route('domain.show', $domain->id)  }}" class="btn btn-info" data-toggle="tooltip" title="{{ __('admin.general.view') }}"><i class="fa fa-fw fa-eye"></i></a>
														<a href="{{ route('domain.edit', $domain->id)  }}" class="btn btn-primary" data-toggle="tooltip" title="{{ __('admin.general.edit') }}"><i class="fa fa-fw fa-edit"></i></a>
														@method('DELETE')
														@csrf
														<button type="submit" class="btn btn-danger remove-item" data-toggle="tooltip" title="{{ __('admin.general.delete') }}"><i class="fa fa-fw fa-trash-o"></i></button>
													</form>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="8" class="text-center">@lang('admin.general.nodata',['name'=> 'Domain'])</td>
										</tr>
									@endif
									</tbody>
								</table>
								{{ $domains->links() }}
							</div>
				    </div>
				</div>
			</div>
		</div>
	</div>
@stop

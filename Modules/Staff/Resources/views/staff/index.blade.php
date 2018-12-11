@extends('adminTheme.default')

@section('title', __('admin.general.manage').' '.__('admin.staff.title'))

@section('content-header')
    <h1>@lang('admin.general.manage') @lang('admin.staff.title')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                @lang('admin.general.dashboard')
            </a>
        </li>
        <li class="active"> @lang('admin.staff.title')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> @lang('admin.general.managedata',['name'=> __('admin.staff.title')])
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ route('staffs.index') }}">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="{{ __('admin.general.search') }}..." name="search"
                                           value="{{ request()->get('search') }}">
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
                                <a class="btn btn-success btn-margin-bt" href="{{ route('staffs.create') }}"><i
                                            class="fa fa-fw fa-plus"></i> @lang('admin.general.create') @lang('admin.staff.title')</a>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-scrollable">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('admin.staff.staffName')</th>
                                        <th>@lang('admin.staff.belongsFrom')</th>
                                        <th>@lang('admin.staff.displayName')</th>
                                        <th width="190px">@lang('admin.general.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($staffs->count() > 0)
                                        @foreach($staffs as $staff)
                                            <tr>
                                                <td>{{ $staff->id }}</td>
                                                <td>{{ $staff->first_name . ' ' . $staff->middle_name . ' ' . $staff->last_name }}</td>
                                                <td>{{ $staff->city->name . ', ' . $staff->state->name . ', ' . $staff->country->name }}</td>
                                                <td>{{ $staff->display_name }}</td>
                                                <td>
                                                    <form action="{{ route('staffs.destroy', $staff->id)  }}" method="POST">
                                                        <a href="{{ route('staffs.show', $staff->id)  }}" class="btn btn-info"
                                                           data-toggle="tooltip" title="View"><i
                                                                    class="fa fa-fw fa-eye"></i></a>
                                                        <a href="{{ route('staffs.edit', $staff->id)  }}"
                                                           class="btn btn-primary" data-toggle="tooltip" title="Edit"><i
                                                                    class="fa fa-fw fa-edit"></i></a>
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger remove-item"
                                                                data-toggle="tooltip" title="Delete"><i
                                                                    class="fa fa-fw fa-trash-o"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">@lang('admin.general.nodata',['name'=> __('admin.staff.title')])</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                {{ $staffs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stop

        @section('script')
            <script>
                $(".remove-item").click(function (e) {
                    e.preventDefault();
                    var cObj = $(this);
                    if (confirm("Are you sure want to remove?")) {
                        cObj.parent('form').submit();
                    }
                });
            </script>
@endsection

@extends('adminTheme.default')

@section('title', __('admin.general.manage').' '.__('admin.staffPosition.title'))

@section('content-header')
    <h1>Manage Country</h1>
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
        <li class="active"> __('admin.staffPosition.title')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="diagram" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> @lang('admin.general.managedata',['name'=> __('admin.staffPosition.title')])
                    </div>
                </div>

                <div class="portlet-body">

                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ route('position.index') }}">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="@lang('admin.general.search')" name="search"
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
                                <a class="btn btn-success btn-margin-bt" href="{{ route('position.create') }}"><i
                                            class="fa fa-fw fa-plus"></i> @lang('admin.general.create') @lang('admin.staffPosition.title')</a>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-scrollable">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('admin.staffPosition.name')</th>
                                        <th>@lang('admin.staffPosition.code')</th>
                                        <th width="190px">@lang('admin.general.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($positions->count() > 0)
                                        @foreach($positions as $position)
                                            <tr>
                                                <td>{{ $position->id }}</td>
                                                <td>{{ $position->position_name }}</td>
                                                <td>{{ $position->position_code }}</td>
                                                <td>
                                                    <form action="{{ route('position.destroy', $position->id)  }}"
                                                          method="POST">
                                                        <a href="{{ route('position.show', $position->id)  }}"
                                                           class="btn btn-info" data-toggle="tooltip" title="View"><i
                                                                    class="fa fa-fw fa-eye"></i></a>
                                                        <a href="{{ route('position.edit', $position->id)  }}"
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
                                            <td colspan="8" class="text-center">@lang('admin.general.nodata',['name'=> __('admin.staffPosition.title')])</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                {{ $positions->links() }}
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
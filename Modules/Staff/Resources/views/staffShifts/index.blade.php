@extends('adminTheme.default')

@section('title', 'Manage Staff Shifts')

@section('content-header')
    <h1>Manage Staff Shifts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#"> Staff</a>
        </li>
        <li class="active"> Staff Shifts</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Manage Staff Shifts Data
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ route('staffShifts.index') }}">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" placeholder="Search..." name="search"
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
                                <a class="btn btn-success btn-margin-bt" href="{{ route('staffShifts.create') }}"><i
                                            class="fa fa-fw fa-plus"></i> Create Staff Shift</a>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-scrollable">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Shift Name</th>
                                        <th>Shift Descr</th>
                                        <th>Start From</th>
                                        <th>Ends At</th>
                                        <th width="190px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($staffShifts->count() > 0)
                                        @foreach($staffShifts as $staffShift)
                                            <tr>
                                                <td>{{ $staffShift->id }}</td>
                                                <td>{{ $staffShift->shift_name }}</td>
                                                <td>{{ $staffShift->shift_descr }}</td>
                                                <td>{{ $staffShift->start_from }}</td>
                                                <td>{{ $staffShift->ends_at }}</td>
                                                <td>
                                                    <form action="{{ route('staffShifts.destroy', $staffShift->id)  }}" method="POST">
                                                        <a href="{{ route('staffShifts.show', $staffShift->id)  }}" class="btn btn-info"
                                                           data-toggle="tooltip" title="View"><i
                                                                    class="fa fa-fw fa-eye"></i></a>
                                                        <a href="{{ route('staffShifts.edit', $staffShift->id)  }}"
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
                                            <td colspan="8" class="text-center">There are no staff shifts.</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                {{ $staffShifts->links() }}
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

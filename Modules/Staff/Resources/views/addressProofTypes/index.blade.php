@extends('adminTheme.default')

@section('title', __('admin.general.manage').' '.__('admin.AddressProofType.title'))

@section('content-header')
    <h1>@lang('admin.AddressProofType.title')</h1>
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
        <li class="active"> @lang('admin.AddressProofType.title')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="map" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> @lang('admin.general.managedata',['name'=> __('admin.AddressProofType.title')])
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ route('addressProofType.index') }}">
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
                                <a class="btn btn-success btn-margin-bt"
                                   href="{{ route('addressProofType.create') }}"><i class="fa fa-fw fa-plus"></i>  @lang('admin.general.create')
                                    @lang('admin.AddressProofType.title')</a>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-scrollable">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('admin.AddressProofType.name')</th>
                                        <th>@lang('admin.AddressProofType.description')</th>
                                        <th width="190px">@lang('admin.general.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($addressProofTypes->count() > 0)
                                        @foreach($addressProofTypes as $addressProofType)
                                            <tr>
                                                <td>{{ $addressProofType->id }}</td>
                                                <td>{{ $addressProofType->proof_name }}</td>
                                                <td>{{ $addressProofType->proof_descr}}</td>
                                                <td>
                                                    <form action="{{ route('addressProofType.destroy', $addressProofType->id)  }}"
                                                          method="POST">
                                                        <a href="{{ route('addressProofType.show', $addressProofType->id)  }}"
                                                           class="btn btn-info" data-toggle="tooltip" title="View"><i
                                                                    class="fa fa-fw fa-eye"></i></a>
                                                        <a href="{{ route('addressProofType.edit', $addressProofType->id)  }}"
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
                                            <td colspan="8" class="text-center">@lang('admin.general.nodata',['name'=> __('admin.AddressProofType.title')])</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                {{ $addressProofTypes->links() }}
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

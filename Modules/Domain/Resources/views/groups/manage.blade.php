@extends('adminTheme.default')

@section('title','Manage Tld Group Detail')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/select2/css/select2-bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/rowReorder.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminTheme/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link href="{{ asset('adminTheme/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content-header')
    <h1>Manage TLD Group</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('admin') }}">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#">Group</a>
        </li>
        <li class="active">Manage</li>
    </ol>
    @include('errors.list')
@endsection

@section('content')
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="livicon" data-name="medal" data-size="16" data-loop ="true" data-c="#fff" data-hc="white"></i>
                    TLD Group
                </h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add-tld-group-modal">Add TLD Group</button>
                </div>
                <div>
                    <ul class="list-inline">
                        <li><a href="{{ route('tld-group.index') }}" >All</a></li>
                        <li><a href="{{ route('tld-group.index') }}?show_deleted=1">Trash</a></li>
                    </ul>
                </div>
                <div id="tld-group-table-wrapper" class="">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer"
                           id="tld-group-table" role="grid">
                        <thead class="table_head">
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="tld-group-table"
                                rowspan="1" colspan="1">Name
                            </th>


                            @if(request('show_deleted') != 1)
                                <th class="sorting" tabindex="0" aria-controls="tld-group-table" rowspan="1"
                                    colspan="1" aria-label="
                                                     Edit
                                                : activate to sort column ascending">Edit
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="tld-group-table" rowspan="1"
                                    colspan="1" aria-label="
                                                     Delete
                                                : activate to sort column ascending">Delete
                                </th>
                            @endif
                            @if(request('show_deleted') == 1)
                                <th class="sorting" tabindex="0" aria-controls="tld-group-table" rowspan="1"
                                    colspan="1" aria-label="
                                                 Restore
                                            : activate to sort column ascending">Restore
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="tld-group-table" rowspan="1"
                                    colspan="1" aria-label="
                                                Permanent Delete
                                            : activate to sort column ascending">Permanent Delete
                                </th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tldGroups as $group)
                            <tr role="row" class="odd" data-id="{{$group->id}}">
                                <td class="sorting_1">{{$group->name}}</td>
                                @if(request('show_deleted') != 1)
                                    <td>
                                        <a class="edit" href="javascript:;">Edit</a>
                                    </td>

                                    <td>
                                        <a class="delete" href="javascript:;">Delete</a>
                                    </td>
                                @endif
                                @if(request('show_deleted') == 1)
                                    <td>
                                        <a class="restore" href="javascript:;">Restore</a>
                                    </td>
                                    <td>
                                        <a class="permanent-delete" href="javascript:;">Permanent Delete</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('domain::partials.tld_group_modal')

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('adminTheme/vendors/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminTheme/vendors/datatables/js/jquery.dataTables.js') }}"></script>
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
    <script type="text/javascript" src="{{ asset('domain/js/manage-tld-group.js') }}"></script>



@endsection

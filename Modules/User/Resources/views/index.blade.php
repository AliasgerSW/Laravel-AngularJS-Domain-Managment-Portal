@extends('adminTheme.default')
@section('title', 'Dashboard')

@section('style')
    <link href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content-header')
    <h1>@lang('admin.general.welcome-dashboard')</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i> @lang('admin.general.dashboard')
            </a>
        </li>
    </ol>
@endsection
@section('content')
    <div class="row" style="display: flex; justify-content: center; margin-top: 50px">
        <div >
            <div>
                <a href="{{route('show.individual.form')}}"  class="btn btn-primary">@lang('admin.user.register-individual')</a>
                <button class="btn btn-primary">@lang('admin.user.register-company')</button>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="container" style="padding-right: 150px">
            <table id="myTable" class="table table-advance table-bordered">
                <thead>
                <th>@lang('admin.user.serail-no')</th>
                <th>@lang('admin.user.name')</th>
                <th>@lang('admin.user.name-phone')</th>
                <th>@lang('admin.user.name-action')</th>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                        <td>{{$contact->phone}}</td>
                        <td><a href="#" class="btn btn-success"> <i class="livicon" data-name="pencil" data-size="14" data-color="#fff" data-hovercolor="#333"></i> @lang('admin.user.edit')</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
@section('script')


    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

    </script>
@endsection



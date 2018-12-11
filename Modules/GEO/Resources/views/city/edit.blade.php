@extends('adminTheme.default')

@section('title',  __('admin.general.edit').' '.__('admin.geo.city'))

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
        <li>
            <a href="{{ route('cities.index') }}"> @lang('admin.geo.city')</a>
        </li>
        <li class="active"> @lang('admin.general.edit') @lang('admin.geo.city')</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="camera" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> @lang('admin.general.edit') @lang('admin.geo.city')
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ route('cities.update', $city->id)  }}" class="form-horizontal" method="POST">
                        @csrf
                        @method('PUT')
                        @include('geo::city.fields')
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop


@section('script')
    <script>
        $("#country_id").change(function(e){
            e.preventDefault();
            var country_id = $(this).val();
            var token = $("input[name='_token']").val();

            $.ajax({
                url: "{{ route('cities.getCountryIdWithState') }}",
                method: 'POST',
                data: {country_id:country_id, _token:token},
                success: function(data) {
                    $('#state_id').html(data.options);
                }
            });
        });
    </script>
@endsection

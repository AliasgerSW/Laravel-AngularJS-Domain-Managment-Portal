<option>--- @lang('admin.general.select') @lang('admin.geo.city.state') ---</option>
@if(!empty($states))
    @foreach($states as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif
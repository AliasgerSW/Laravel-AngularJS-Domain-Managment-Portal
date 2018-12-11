<fieldset>

	<!-- Enter Country Field -->
	<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="country_id">@lang('admin.geo.city.country'):</label>
		<div class="col-md-8">
			<select name="country_id" id="country_id" class="form-control">
				<option value="">--- @lang('admin.general.select') @lang('admin.geo.city.country') ---</option>
				@php
					$sel = isset($city->country_id) ? $city->country_id : old('country_id');
				@endphp
				@if(!empty($countriesList))
					@foreach($countriesList as $id => $name)
						<option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
					@endforeach
				@endif
			</select>
			@if($errors->has('country_id'))
				<p class="text-danger">{{ $errors->first('country_id') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter State Field -->
	<div class="form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="state_id">@lang('admin.geo.city.state'):</label>
		<div class="col-md-8">
			<select name="state_id" id="state_id" class="form-control">
				<option value="">--- @lang('admin.general.select') @lang('admin.geo.city.state') ---</option>
				@php
					$sel = isset($city->state_id) ? $city->state_id : old('state_id');
				@endphp
				@if(!empty($statesList))
					@foreach($statesList as $id => $name)
						<option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
					@endforeach
				@endif
			</select>
			@if($errors->has('state_id'))
				<p class="text-danger">{{ $errors->first('state_id') }}</p>
			@endif
		</div>
	</div>

	<!-- Name input-->
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="name">@lang('admin.geo.city.name'):</label>
		<div class="col-md-8">
			<input type="text" id="name" name="name" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.city.name') }}" value="{{ isset($city->name) ? $city->name : old('name') }}">
			@if($errors->has('name'))
				<p class="text-danger">{{ $errors->first('name') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Latitude Field -->
	<div class="form-group {{ $errors->has('latitude') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="latitude">@lang('admin.geo.city.latitude'):</label>
		<div class="col-md-8">
			<input type="text" id="latitude" name="latitude" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.city.latitude') }}" value="{{ isset($city->latitude) ? $city->code : old('latitude') }}">
			@if($errors->has('latitude'))
				<p class="text-danger">{{ $errors->first('latitude') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Longitude Field -->
	<div class="form-group {{ $errors->has('longitude') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="longitude">@lang('admin.geo.city.longitude'):</label>
		<div class="col-md-8">
			<input type="text" id="longitude" name="longitude" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.city.longitude') }}" value="{{ isset($city->longitude) ? $city->longitude : old('longitude') }}">
			@if($errors->has('longitude'))
				<p class="text-danger">{{ $errors->first('longitude') }}</p>
			@endif
		</div>
	</div>

	<!-- Submit Field -->
	<div class="form-group text-center">
		<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> @lang('admin.general.save')</button>
		<a href="{!! route('cities.index') !!}" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> @lang('admin.general.cancel')</a>
	</div>

</fieldset>
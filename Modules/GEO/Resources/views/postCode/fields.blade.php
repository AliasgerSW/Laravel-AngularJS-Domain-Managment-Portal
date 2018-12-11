<fieldset>

	<!-- Select City Field -->
	<div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="city_id">@lang('admin.geo.postcode.city'):</label>
		<div class="col-md-8">
			<select name="city_id" id="city_id" class="form-control">
				<option value="">--- @lang('admin.general.select') @lang('admin.geo.postcode.city') ---</option>
				@php
					$sel = isset($postCode->city_id) ? $postCode->city_id : old('city_id');
				@endphp
			    @if(!empty($cityList))
					@foreach($cityList as $id => $name)
						<option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
					@endforeach
				@endif
			</select>
			@if($errors->has('city_id'))
				<p class="text-danger">{{ $errors->first('city_id') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Code Field -->
	<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="code">@lang('admin.geo.postcode.code'):</label>
		<div class="col-md-8">
			<input type="text" id="code" name="code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.postcode.code') }}" value="{{ isset($postCode->code) ? $postCode->code : old('code') }}">
			@if($errors->has('code'))
				<p class="text-danger">{{ $errors->first('code') }}</p>
			@endif
		</div>
	</div>

	<!-- Submit Field -->
	<div class="form-group text-center">
		<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> @lang('admin.general.save')</button>
		<a href="{!! route('states.index') !!}" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> @lang('admin.general.cancel')</a>
	</div>

</fieldset>
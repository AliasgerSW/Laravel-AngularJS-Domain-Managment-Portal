<fieldset>

	<!-- Name input-->
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="name">@lang('admin.geo.country.name'):</label>
		<div class="col-md-8">
			<input type="text" id="name" name="name" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.country.name') }}" value="{{ isset($country->name) ? $country->name : old('name') }}">
			@if($errors->has('name'))
				<p class="text-danger">{{ $errors->first('name') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter ISO Alpha Code 2 Field -->
	<div class="form-group {{ $errors->has('iso_alpha_2_code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="iso_alpha_2_code">@lang('admin.geo.country.IsoAlphaCode2'):</label>
		<div class="col-md-8">
			<input type="text" id="iso_alpha_2_code" name="iso_alpha_2_code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.country.IsoAlphaCode2') }}" value="{{ isset($country->iso_alpha_2_code) ? $country->iso_alpha_2_code : old('iso_alpha_2_code') }}">
			@if($errors->has('iso_alpha_2_code'))
				<p class="text-danger">{{ $errors->first('iso_alpha_2_code') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter ISO Alpha Code 3 Field -->
	<div class="form-group {{ $errors->has('iso_alpha_3_code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="iso_alpha_3_code">@lang('admin.geo.country.IsoAlphaCode3'):</label>
		<div class="col-md-8">
			<input type="text" id="iso_alpha_3_code" name="iso_alpha_3_code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.country.IsoAlphaCode3') }}" value="{{ isset($country->iso_alpha_3_code) ? $country->iso_alpha_3_code : old('iso_alpha_3_code') }}">
			@if($errors->has('iso_alpha_3_code'))
				<p class="text-danger">{{ $errors->first('iso_alpha_3_code') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter ISO Numeric Code Field -->
	<div class="form-group {{ $errors->has('iso_numeric_code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="iso_numeric_code">@lang('admin.geo.country.IsoNumericCode'):</label>
		<div class="col-md-8">
			<input type="text" id="iso_numeric_code" name="iso_numeric_code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.country.IsoNumericCode') }}" value="{{ isset($country->iso_numeric_code) ? $country->iso_numeric_code : old('iso_numeric_code') }}">
			@if($errors->has('iso_numeric_code'))
				<p class="text-danger">{{ $errors->first('iso_numeric_code') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Code Field -->
	<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="code">@lang('admin.geo.country.code'):</label>
		<div class="col-md-8">
			<input type="text" id="code" name="code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.country.code') }}" value="{{ isset($country->code) ? $country->code : old('code') }}">
			@if($errors->has('code'))
				<p class="text-danger">{{ $errors->first('code') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter TLD Field -->
	<div class="form-group {{ $errors->has('tld') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="tld">@lang('admin.geo.country.Tld'):</label>
		<div class="col-md-8">
			<input type="text" id="tld" name="tld" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.country.Tld') }}" value="{{ isset($country->tld) ? $country->tld : old('tld') }}">
			@if($errors->has('tld'))
				<p class="text-danger">{{ $errors->first('tld') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Language Field -->
	<div class="form-group {{ $errors->has('language_id') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="language_id">@lang('admin.geo.country.language'):</label>
		<div class="col-md-8">
			<select name="language_id[]" id="language_id" class="form-control" multiple="multiple">
				@php
					$sel = isset($city->language_id) ? $city->language_id : old('language_id');
				@endphp
				@if(!empty($languagesList))
					@foreach($languagesList as $id => $name)
						<option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
					@endforeach
				@endif
			</select>
			@if($errors->has('language_id'))
				<p class="text-danger">{{ $errors->first('language_id') }}</p>
			@endif
		</div>
	</div>


	<!-- Submit Field -->
	<div class="form-group text-center">
		<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> @lang('admin.general.save')</button>
		<a href="{!! route('countries.index') !!}" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>  @lang('admin.general.cancel')</a>
	</div>

</fieldset>
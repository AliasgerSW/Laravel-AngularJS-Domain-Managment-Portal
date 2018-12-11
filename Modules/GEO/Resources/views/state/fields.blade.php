<fieldset>

	<!-- Enter ISO Alpha Code 2 Field -->
	<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="country_id">@lang('admin.geo.state.country'):</label>
		<div class="col-md-8">
			<select name="country_id" id="country_id" class="form-control">
				<option value="">--- @lang('admin.general.select') @lang('admin.geo.state.country') ---</option>
				@php
					$sel = isset($state->country_id) ? $state->country_id : old('country_id');
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

	<!-- Name input-->
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="name">@lang('admin.geo.state.name'):</label>
		<div class="col-md-8">
			<input type="text" id="name" name="name" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.state.name') }}" value="{{ isset($state->name) ? $state->name : old('name') }}">
			@if($errors->has('name'))
				<p class="text-danger">{{ $errors->first('name') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Code Field -->
	<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="code">@lang('admin.geo.state.code'):</label>
		<div class="col-md-8">
			<input type="text" id="code" name="code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.state.code') }}" value="{{ isset($state->code) ? $state->code : old('code') }}">
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
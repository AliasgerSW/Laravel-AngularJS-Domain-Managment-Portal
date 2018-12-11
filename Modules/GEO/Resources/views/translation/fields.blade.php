<fieldset>

	<!-- Language Field -->
	<div class="form-group {{ $errors->has('language_id') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="language_id">@lang('admin.geo.translation.language'):</label>
		<div class="col-md-8">
			{{--


			<select name="language_id" id="language_id" class="form-control">
				<option value="">--- Select Language ---</option>
				@php
					$sel = 'en';
				@endphp
				@if(!empty($languageList))
					@foreach($languageList as $id => $name)
						<option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }} readonly="true">{{$name}}</option>
					@endforeach
				@endif
			</select>
			@if($errors->has('language_id'))
				<p class="text-danger">{{ $errors->first('language_id') }}</p>
			@endif
			--}}
			<input type="text" disabled value="English" class="form-control">
			<input type="hidden" value="en" name="language_id">
		</div>
	</div>

	<!-- Key Input-->
	<div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="key">@lang('admin.geo.translation.key'):</label>
		<div class="col-md-8">
			<input type="text" id="key" name="key" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.translation.key') }}" value="{{ old('key') }}">
			@if($errors->has('key'))
				<p class="text-danger">{{ $errors->first('key') }}</p>
			@endif
		</div>
	</div>

	<!-- Value Input-->
	<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="value">@lang('admin.geo.translation.value'):</label>
		<div class="col-md-8">
			<input type="text" id="value" name="value" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.translation.value') }}" value="{{ old('value') }}">
			@if($errors->has('value'))
				<p class="text-danger">{{ $errors->first('value') }}</p>
			@endif
		</div>
	</div>

	<!-- Submit Field -->
	<div class="form-group text-center">
		<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> @lang('admin.general.save')</button>
		<a href="{!! route('languages.index') !!}" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> @lang('admin.general.cancel')</a>
	</div>

</fieldset>
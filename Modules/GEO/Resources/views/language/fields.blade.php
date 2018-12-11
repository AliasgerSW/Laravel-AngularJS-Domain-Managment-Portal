<fieldset>

	<!-- English Name input-->
	<div class="form-group {{ $errors->has('name_english') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="name_english">@lang('admin.geo.language.nameenglish'):</label>
		<div class="col-md-8">
			<input type="text" id="name_english" name="name_english" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.language.nameenglish') }}" value="{{ isset($language->name_english) ? $language->name_english : old('name_english') }}">
			@if($errors->has('name_english'))
				<p class="text-danger">{{ $errors->first('name_english') }}</p>
			@endif
		</div>
	</div>

	<!-- Name input-->
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="name">@lang('admin.geo.language.name'):</label>
		<div class="col-md-8">
			<input type="text" id="name" name="name" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.language.name') }}" value="{{ isset($language->name) ? $language->name : old('name') }}">
			@if($errors->has('name'))
				<p class="text-danger">{{ $errors->first('name') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Code Field -->
	<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="code">@lang('admin.geo.language.code'):</label>
		<div class="col-md-8">
			<div class="form-group input-group">
				<input type="text" id="code" name="code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.language.code') }}" value="{{ isset($language->code) ? $language->code : old('code') }}">
				<span class="input-group-addon text-primary like-json">{{ isset($language->code) ? $language->code.'.json' : 'Like: en.json' }}</span>
			</div>
			@if($errors->has('code'))
				<p class="text-danger">{{ $errors->first('code') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Script Type Field -->
	<div class="form-group {{ $errors->has('script_type') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="script_type">@lang('admin.geo.language.scripttype'):</label>
		<div class="col-md-8">
			<input type="text" id="script_type" name="script_type" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.language.scripttype') }}" value="{{ isset($language->script_type) ? $language->script_type : old('script_type') }}">
			@if($errors->has('script_type'))
				<p class="text-danger">{{ $errors->first('script_type') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Language Family Field -->
	<div class="form-group {{ $errors->has('family') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="family">@lang('admin.geo.language.family'):</label>
		<div class="col-md-8">
			<input type="text" id="family" name="family" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.language.family') }}" value="{{ isset($language->family) ? $language->family : old('family') }}">
			@if($errors->has('family'))
				<p class="text-danger">{{ $errors->first('family') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Language Type Field -->
	<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="type">@lang('admin.geo.language.type'):</label>
		<div class="col-md-8">
			<input type="text" id="type" name="type" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.language.type') }}" value="{{ isset($language->type) ? $language->type : old('type') }}">
			@if($errors->has('type'))
				<p class="text-danger">{{ $errors->first('type') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter Language Type ISO Code Field -->
	<div class="form-group {{ $errors->has('type_iso_code') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="type_iso_code">@lang('admin.geo.language.typeIsoCode'):</label>
		<div class="col-md-8">
			<input type="text" id="type_iso_code" name="type_iso_code" class="form-control" placeholder="{{ __('admin.general.enter') }} {{ __('admin.geo.language.typeIsoCode') }}" value="{{ isset($language->type_iso_code) ? $language->type_iso_code: old('type_iso_code') }}">
			@if($errors->has('type_iso_code'))
				<p class="text-danger">{{ $errors->first('type_iso_code') }}</p>
			@endif
		</div>
	</div>

	<!-- Enter IS Translate Field -->
	<div class="form-group {{ $errors->has('is_translate') ? 'has-error' : '' }}">
		<label class="col-md-3 control-label" for="is_translate">@lang('admin.geo.language.istranslate')?:</label>
		<div class="col-md-8">
			@if(!empty($language->is_translate))
			    <input type="checkbox" name="is_translate" data-size="normal" checked>
			@else
				<input type="checkbox" name="is_translate" data-size="normal">
			@endif
			@if($errors->has('is_translate'))
				<p class="text-danger">{{ $errors->first('is_translate') }}</p>
			@endif
		</div>
	</div>

	<!-- Submit Field -->
	<div class="form-group text-center">
		<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> @lang('admin.general.save')</button>
		<a href="{!! route('languages.index') !!}" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>  @lang('admin.general.cancel')</a>
	</div>

</fieldset>
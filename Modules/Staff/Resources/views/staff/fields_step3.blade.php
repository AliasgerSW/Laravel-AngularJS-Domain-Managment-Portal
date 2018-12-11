<!-- Display Name -->
<div class="form-group">
    <label class="col-md-3 control-label" for="display_name">@lang('admin.staff.displayName'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="display_name" ng-init="display_name='{{ isset($staff->display_name) ? $staff->display_name: old('display_name') }}'" name="display_name" class="form-control" placeholder="@lang('admin.staff.displayName')" minlength="2" maxlength="30"
               value="" ng-required="currStep==3" ng-model="display_name">
        <p class="error ng-hide" ng-show="staffForm.display_name.$touched && staffForm.display_name.$invalid">@lang('admin.staff.validation.displayName')</p>
        @if($errors->has('display_name'))
            <p class="text-danger">{{ $errors->first('display_name') }}</p>
        @endif
    </div>
</div>

<!-- profile image -->
<div class="form-group">
    <label class="col-md-3 control-label" for="profile_image">@lang('admin.staff.profileImage'): <span class="error">*</span></label>
    <div class="col-md-8">
        @if(!empty($staff))
            <img src="{{ $staff->profile_image }}" width="120px" alt="" style="margin-bottom:10px;">
        @endif
        <input type="file" id="profile_image" name="profile_image" class="form-control" data-file
               value="" ng-model="profile_image" ng-required="currStep==3 && !isEditMode">
        <p class="error ng-hide" ng-show="staffForm.profile_image.$touched && staffForm.profile_image.$invalid">@lang('admin.staff.validation.profileImage')</p>
        @if($errors->has('display_name'))
            <p class="text-danger">{{ $errors->first('profile_image') }}</p>
        @endif
    </div>
</div>

<!-- Interest -->
<div class="form-group {{ $errors->has('interest') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="interest">@lang('admin.staff.interest'):</label>
    <div class="col-md-8">
        <textarea name="interest" id="interest" ng-init="interest='{{ isset($staff->interest) ? $staff->interest: old('interest') }}'" class="form-control" cols="30" rows="3" maxlength="500">{{ isset($staff->interest) ? $staff->interest: old('interest') }}</textarea>
        @if($errors->has('interest'))
            <p class="text-danger">{{ $errors->first('interest') }}</p>
        @endif
    </div>
</div>

<!-- Skills -->
<div class="form-group {{ $errors->has('skills') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="skills">@lang('admin.staff.skills'):</label>
    <div class="col-md-8" ng-init="skills='{{ isset($staff->skills) ? $staff->skills: old('skills') }}'">
        <textarea name="skills" id="skills" class="form-control" cols="30" rows="3" maxlength="200"
                  placeholder="Enter Skills using comma separated" ng-model="skills"></textarea>
        @if($errors->has('skills'))
            <p class="text-danger">{{ $errors->first('skills') }}</p>
        @endif
    </div>
</div>

<!-- Language -->
<div class="form-group {{ $errors->has('language') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="language">@lang('admin.staff.languages'):</label>
    <div class="col-md-8" ng-init="language='{{ isset($staff->language) ? $staff->language: old('language') }}'">
        <textarea name="language" id="language" ng-model="language" class="form-control" cols="30" rows="3" maxlength="200"
                  placeholder="Enter Languages using comma separated"></textarea>
        @if($errors->has('language'))
            <p class="text-danger">{{ $errors->first('language') }}</p>
        @endif
    </div>
</div>

<!-- About me -->
<div class="form-group {{ $errors->has('aboutme') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="aboutme">@lang('admin.staff.aboutMe'):</label>
    <div class="col-md-8" ng-init="aboutme='{{ isset($staff->aboutme) ? $staff->aboutme: old('aboutme') }}'">
        <textarea name="aboutme" id="aboutme" class="form-control" cols="30" rows="10" placeholder="@lang('admin.general.enter') @lang('admin.staff.aboutMe')" ng-model="aboutme"></textarea>
        @if($errors->has('aboutme'))
            <p class="text-danger">{{ $errors->first('aboutme') }}</p>
        @endif
    </div>
</div>

<!-- Enter Staff Type -->
<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="status">@lang('admin.staff.status'):</label>
    <div class="col-md-8" ng-init="status='{{ isset($staff->status) ? $staff->status: old('status') }}'">
        <select name="status" id="status" class="form-control" ng-model="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        @if($errors->has('status'))
            <p class="text-danger">{{ $errors->first('status') }}</p>
        @endif
    </div>
</div>

<input type="hidden" name="staff_type" value="P" />

{{--
Will enable this part of code after doing cron job work
<!-- Enter Staff Type -->
<div class="form-group {{ $errors->has('staff_type') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="staff_type">Staff Type:</label>
    <div class="col-md-8">
        <select name="staff_type" id="staff_type" class="form-control">
            <option value="P">Permanent</option>
            <option value="T">Temporary</option>
        </select>
        @if($errors->has('staff_type'))
            <p class="text-danger">{{ $errors->first('staff_type') }}</p>
        @endif
    </div>
</div>

<!-- Enter Expiry date -->
<div class="form-group {{ $errors->has('staff_type') ? 'has-error' : '' }}" ng-show="staff_type='T'">
    <label class="col-md-3 control-label" for="staff_type">Expired On:</label>
    <div class="col-md-8"> <span class="error">*</span>
        <input type="date" class="form-control" ng-model="expired_on" ng-required="currStep=3 && staff_type='T'">
        @if($errors->has('staff_type'))
            <p class="text-danger">{{ $errors->first('staff_type') }}</p>
        @endif
    </div>
</div>--}}
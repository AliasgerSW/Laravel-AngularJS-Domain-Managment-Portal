<!-- First Name -->
<div class="form-group">
    <label class="col-md-3 control-label" for="first_name">@lang('admin.staff.firstName'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="first_name" name="first_name" ng-init="first_name='{{ isset($staff->first_name) ? $staff->first_name : old('first_name') }}'" class="form-control" placeholder="@lang('admin.staff.firstName')" minlength="2" maxlength="30"
               value="" ng-required="currStep==1" ng-model="first_name">
        <p class="error ng-hide" ng-show="staffForm.first_name.$touched && staffForm.first_name.$invalid">@lang('admin.staff.validation.firstName')</p>
        @if($errors->has('first_name'))
            <p class="text-danger">{{ $errors->first('first_name') }}</p>
        @endif
    </div>
</div>

<!-- Middle Name -->
<div class="form-group">
    <label class="col-md-3 control-label" for="middle_name">@lang('admin.staff.middleName'):</label>
    <div class="col-md-8">
        <input type="text" id="middle_name" ng-init="middle_name='{{ isset($staff->middle_name) ? $staff->middle_name: old('middle_name') }}'" name="middle_name" class="form-control" placeholder="@lang('admin.staff.middleName')" minlength="2" maxlength="30"
               value="" ng-model="middle_name">
        <p class="error ng-hide" ng-show="staffForm.first_name.$touched && staffForm.middle_name.$invalid">@lang('admin.staff.validation.middleName')</p>
        @if($errors->has('middle_name'))
            <p class="text-danger">{{ $errors->first('middle_name') }}</p>
        @endif
    </div>
</div>

<!-- Last Name -->
<div class="form-group">
    <label class="col-md-3 control-label" for="last_name">@lang('admin.staff.lastName'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="last_name" name="last_name" ng-init="last_name='{{ isset($staff->last_name) ? $staff->last_name: old('last_name') }}'" class="form-control" placeholder="@lang('admin.staff.lastName')" minlength="2" maxlength="30"
               value="" ng-required="currStep==1" ng-model="last_name">
        <p class="error ng-hide" ng-show="staffForm.last_name.$touched && staffForm.last_name.$invalid">@lang('admin.staff.validation.lastName')</p>
        @if($errors->has('last_name'))
            <p class="text-danger">{{ $errors->first('last_name') }}</p>
        @endif
    </div>
</div>

<!-- Gender -->
<div class="form-group">
    <label class="col-md-3 control-label" for="gender">@lang('admin.staff.gender'): <span class="error">*</span></label>
    <div class="col-md-8">
        <label class="radio-inline">
            <input type="radio" name="gender" value="M" ng-model="gender" ng-required="currStep==1">Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="F" ng-model="gender">Female
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="O" ng-model="gender">Others
        </label>
        <p class="error ng-hide" ng-show="staffForm.gender.$touched && staffForm.gender.$invalid">@lang('admin.staff.validation.gender')</p>
        @if($errors->has('gender'))
            <p class="text-danger">{{ $errors->first('gender') }}</p>
        @endif
    </div>
</div>

<!-- Email -->
<div class="form-group">
    <label class="col-md-3 control-label" for="email">@lang('admin.staff.email'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="email" id="email" ng-init="email='{{ isset($staff->email) ? $staff->email: old('email') }}'" name="email" class="form-control" placeholder="@lang('admin.staff.email')"
               value="" ng-required="currStep==1" ng-model="email" maxlength="200">
        <p class="error ng-hide" ng-show="staffForm.email.$touched && staffForm.email.$invalid">@lang('admin.staff.validation.email')</p>
        @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>
</div>

<!-- Email -->
<div class="form-group">
    <label class="col-md-3 control-label" for="p_email">@lang('admin.staff.personalEmail'):</label>
    <div class="col-md-8">
        <input type="email" id="p_email" ng-init="p_email='{{ isset($staff->p_email) ? $staff->p_email: old('p_email') }}'" name="p_email" class="form-control" placeholder="@lang('admin.staff.personalEmail')"
               value="" ng-model="p_email" maxlength="200">
        <p class="error ng-hide" ng-show="staffForm.p_email.$touched && staffForm.p_email.$invalid">@lang('admin.staff.validation.personalEmail')</p>
        @if($errors->has('p_email'))
            <p class="text-danger">{{ $errors->first('p_email') }}</p>
        @endif
    </div>
</div>

<!-- Staff Level -->
<div class="form-group {{ $errors->has('user_level') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="user_level">@lang('admin.staff.staffLevel'): <span class="error">*</span></label>
    <div class="col-md-8">
        <select name="user_level" id="user_level" ng-init="user_level='{{ isset($staff->user_level) ? $staff->user_level: old('user_level') }}'" class="form-control" ng-model="user_level" ng-required="currStep==1">
            <option value="">--- @lang('admin.general.select') @lang('admin.staff.staffLevel') ---</option>
            <option value="1">Super Administrator</option>
            <option value="2">Administrator</option>
            <option value="3">Manager</option>
            <option value="4">Accountant</option>
            <option value="5">General Staff</option>
            <option value="6">Supporterf</option>
        </select>
        <p class="error ng-hide" ng-show="staffForm.user_level.$touched && staffForm.user_level.$invalid">@lang('admin.staff.validation.staffLevel')</p>
        @if($errors->has('user_level'))
            <p class="text-danger">{{ $errors->first('user_level') }}</p>
        @endif
    </div>
</div>

<!-- Enter Country Field -->
<div class="form-group {{ $errors->has('staff_position_id') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="staff_position_id">@lang('admin.staff.position'): <span class="error">*</span></label>
    <div class="col-md-8">
        <select name="staff_position_id" ng-init="staff_position_id='{{ isset($staff->staff_position_id) ? $staff->staff_position_id: old('staff_position_id') }}'" id="staff_position_id" class="form-control" ng-model="staff_position_id" ng-required="currStep==1">
            <option value="">--- @lang('admin.general.select') @lang('admin.staff.position') ---</option>
            @php
                $sel = isset($staff->staff_position_id) ? $staff->staff_position_id : old('staff_position_id');
            @endphp
            @if(!empty($positionsList))
                @foreach($positionsList as $id => $name)
                    <option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
                @endforeach
            @endif
        </select>
        <p class="error ng-hide" ng-show="staffForm.staff_position_id.$touched && staffForm.staff_position_id.$invalid">@lang('admin.staff.validation.position')</p>
        @if($errors->has('staff_position_id'))
            <p class="text-danger">{{ $errors->first('staff_position_id') }}</p>
        @endif
    </div>
</div>

<!-- Username -->
<div class="form-group">
    <label class="col-md-3 control-label" for="username">@lang('admin.staff.username') <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="username" ng-init="username='{{ isset($staff->username) ? $staff->username: old('username') }}'" name="username" class="form-control" placeholder="@lang('admin.staff.username')"
               value=""
               ng-pattern="usernameRegex" ng-model="username" ng-required="currStep==1">
        <p class="error ng-hide" ng-show="staffForm.username.$touched && staffForm.username.$error.pattern">@lang('admin.staff.validation.username.alphaNumeric')</p>
        <p class="error ng-hide" ng-show="!staffForm.username.$error.pattern && staffForm.username.$touched && staffForm.username.$invalid">@lang('admin.staff.validation.username.required')</p>
        @if($errors->has('username'))
            <p class="text-danger">{{ $errors->first('username') }}</p>
        @endif
    </div>
</div>

<!-- Password -->
<div class="form-group">
    <label class="col-md-3 control-label" for="password">@lang('admin.staff.password') <span class="error" ng-if="!isEditMode">*</span></label>
    <div class="col-md-8">
        <input type="password" id="password" name="password" class="form-control" placeholder="@lang('admin.staff.password')"
               value="{{ isset($staff->password) ? $staff->password: old('password') }}"
               ng-pattern="passwordRegex" minlength="8" ng-model="password" {{ isset($staff->username) ? '' : 'ng-required="currStep==1"' }} >
        <p class="error ng-hide" ng-show="staffForm.password.$touched && staffForm.password.$error.pattern">@lang('admin.staff.validation.password.info')</p>
        <p class="error ng-hide" ng-show="staffForm.password.$touched && !staffForm.password.$error.pattern && staffForm.password.$error.minlength">@lang('admin.staff.validation.password.8Digits')</p>
        <p class="error ng-hide" ng-show="!staffForm.password.$error.minlength && !staffForm.password.$error.pattern && staffForm.password.$touched && staffForm.password.$invalid">@lang('admin.staff.validation.password.required')</p>
        @if($errors->has('password'))
            <p class="text-danger">{{ $errors->first('password') }}</p>
        @endif
    </div>
</div>

<!-- Confirm Password -->
<div class="form-group">
    <label class="col-md-3 control-label" for="cpassword">@lang('admin.staff.confirmPassword') <span class="error" ng-if="!isEditMode">*</span></label>
    <div class="col-md-8">
        <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="@lang('admin.staff.confirmPassword')"
               ng-model="cpassword" compare-to="password"
               value="{{ isset($staff->cpassword) ? $staff->cpassword: old('cpassword') }}" {{ isset($staff->username) ? '' : 'ng-required="currStep==1"' }}>
        <p class="error ng-hide" ng-show="staffForm.cpassword.$touched && staffForm.cpassword.$error.compareTo">@lang('admin.staff.validation.confirmPassword')</p>
        <p class="error ng-hide" ng-show="!staffForm.cpassword.$error.compareTo && staffForm.cpassword.$touched
            && staffForm.cpassword.$invalid">Please Confirm Password</p>
        @if($errors->has('cpassword'))
            <p class="text-danger">{{ $errors->first('cpassword') }}</p>
        @endif
    </div>
</div>


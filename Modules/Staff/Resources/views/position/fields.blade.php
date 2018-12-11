<!-- Position Name-->
<div class="form-group {{ $errors->has('position_name') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="position_name">@lang('admin.staffPosition.name') : <span class="error">*</span></label>
    <div class="col-md-8"
         ng-init="position_name='{{ isset( $position->position_name) ? $position->position_name : old('position_name') }}'">
        <input type="text" id="position_name" name="position_name" class="form-control" placeholder="Position Name"
               ng-model="position_name" maxlength="30" required>
        <p class="error ng-hide"
           ng-show="!positionForm.position_name.$error.ngPattern && positionForm.position_name.$touched && positionForm.position_name.$invalid">
            Please enter Position Unique Code</p>
        @if($errors->has('position_name'))
            <p class="text-danger">{{ $errors->first('position_name') }}</p>
        @endif
    </div>
</div>

<!-- Position Code -->
<div class="form-group {{ $errors->has('position_code') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="position_code">@lang('admin.staffPosition.code') :</label>
    <div class="col-md-8"
         ng-init="position_code='{{ isset($position->position_code) ? $position->position_code : old('position_code') }}'">
        <input type="text" id="position_code" name="position_code" class="form-control"
               placeholder="Position Short Code" ng-pattern="codeRegex"
               ng-model="position_code" maxlength="10" required>
        <p class="error ng-hide"
           ng-show="positionForm.position_code.$touched && positionForm.position_code.$error.pattern">Code only
            consist of Alpha-numeric characters</p>
        <p class="error ng-hide"
           ng-show="!positionForm.position_code.$error.pattern && positionForm.position_code.$touched && positionForm.position_code.$invalid">
            Please enter Position Unique Code</p>
        @if($errors->has('position_code'))
            <p class="text-danger">{{ $errors->first('position_code') }}</p>
        @endif
    </div>
</div>
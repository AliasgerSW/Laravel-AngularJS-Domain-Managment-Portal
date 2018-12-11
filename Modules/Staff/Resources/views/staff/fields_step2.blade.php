<!-- Enter Country Field -->
<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="country_id">@lang('admin.staff.country'): <span class="error">*</span></label>
    <div class="col-md-8">
        <select name="country_id" id="country_id" ng-init="country_id='{{ isset($staff->country_id) ? $staff->country_id : old('country_id') }}'" class="form-control" ng-model="country_id" ng-required="currStep==2">
            <option value="">--- @lang('admin.general.select') @lang('admin.staff.country') ---</option>
            @php
                $sel = isset($staff->country_id) ? $staff->country_id : old('country_id');
            @endphp
            @if(!empty($countriesList))
                @foreach($countriesList as $id => $name)
                    <option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
                @endforeach
            @endif
        </select>
        <p class="error ng-hide" ng-show="staffForm.country_id.$touched && staffForm.country_id"> <span class="error">*</span>$invalid">@lang('admin.staff.validation.country')</p>

        @if($errors->has('country_id'))
            <p class="text-danger">{{ $errors->first('country_id') }}</p>
        @endif
    </div>
</div>

<!-- Enter State Field -->
<div class="form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="state_id">@lang('admin.staff.state'): <span class="error">*</span></label>
    <div class="col-md-8">
        <select name="state_id" id="state_id" ng-init="state_id='{{ isset($staff->state_id) ? $staff->state_id : old('state_id') }}'" class="form-control" ng-model="state_id" ng-required="currStep==2">
            <option value="">--- @lang('admin.general.select') @lang('admin.staff.state') ---</option>
            <option value="<% id %>" ng-repeat="(id, state) in stateslist"><% state %></option>
        </select>
        <p class="error ng-hide" ng-show="staffForm.state_id.$touched && staffForm.state_id.$invalid">@lang('admin.staff.validation.state')</p>
        @if($errors->has('state_id'))
            <p class="text-danger">{{ $errors->first('state_id') }}</p>
        @endif
    </div>
</div>

<!-- Enter City Field -->
<div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="city_id">@lang('admin.staff.city'): <span class="error">*</span></label>
    <div class="col-md-8">
        <select name="city_id" ng-init="city_id='{{ !empty($staff->city_id) ? $staff->city_id : old('city_id') }}'" id="city_id" class="form-control" ng-model="city_id" ng-required="currStep==2">
            <option value="">--- @lang('admin.general.select') @lang('admin.staff.city') ---</option>
            <option value="<% id %>" ng-repeat="(id, city) in citieslist"><% city %></option>
            {{--@if(!empty($cityList))
                @foreach($cityList as $id => $name)
                    <option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
                @endforeach
            @endif--}}
        </select>
        <p class="error ng-hide" ng-show="staffForm.city_id.$touched && staffForm.city_id.$invalid">@lang('admin.staff.validation.city')</p>
        @if($errors->has('city_id'))
            <p class="text-danger">{{ $errors->first('city_id') }}</p>
        @endif
    </div>
</div>

<!-- Enter Zipcode Field -->
<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="zipcode">@lang('admin.staff.zipCode'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="zipcode" ng-init="zipcode='{{ isset($staff->zipcode) ? $staff->zipcode : old('zipcode') }}'" name="zipcode" class="form-control" placeholder="@lang('admin.general.enter') @lang('admin.staff.zipCode')"
               ng-pattern="zipRegex" value=""
               ng-model="zipcode" ng-required="currStep==2">
        <p class="error ng-hide" ng-show="staffForm.zipcode.$touched && staffForm.zipcode.$invalid">@lang('admin.staff.validation.zipCode')</p>
        @if($errors->has('zipcode'))
            <p class="text-danger">{{ $errors->first('zipcode') }}</p>
        @endif
    </div>
</div>

<!-- Enter Address Field -->
<div class="form-group {{ $errors->has('address1') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="address1">@lang('admin.staff.address1'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="address1" ng-init="address1='{{ isset($staff->address1) ? $staff->address1 : old('address1') }}'" name="address1" class="form-control" placeholder="@lang('admin.general.enter') @lang('admin.staff.address1')" maxlength="50"
               value="" ng-model="address1" ng-required="currStep==2">
        <p class="error ng-hide" ng-show="staffForm.zipcode.$touched && staffForm.zipcode.$invalid">@lang('admin.staff.validation.address1')</p>
        @if($errors->has('address1'))
            <p class="text-danger">{{ $errors->first('address1') }}</p>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="text" id="address2" ng-init="address2='{{ isset($staff->address2) ? $staff->address2 : old('address2') }}'" name="address2" class="form-control" placeholder="@lang('admin.general.enter') @lang('admin.staff.address2')" maxlength="50"
               value=""  ng-model="address2">
        @if($errors->has('address2'))
            <p class="text-danger">{{ $errors->first('address2') }}</p>
        @endif
    </div>
</div>
<div class="form-group {{ $errors->has('address3') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <input type="text" id="address3" name="address3" ng-init="address3='{{ isset($staff->address3) ? $staff->address3 : old('address3') }}'" class="form-control" placeholder="@lang('admin.general.enter') @lang('admin.staff.address3')"
               value="" maxlength="50"  ng-model="address3">
        @if($errors->has('address3'))
            <p class="text-danger">{{ $errors->first('address3') }}</p>
        @endif
    </div>
</div>

<!-- Enter Phone 1 Field -->
<div class="form-group {{ $errors->has('phone1') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="phone1">@lang('admin.staff.mobileNumber'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="phone1" ng-init="phone1='{{ isset($staff->phone1) ? $staff->phone1 : old('phone1') }}'" name="phone1" class="form-control" placeholder="@lang('admin.general.enter') @lang('admin.staff.mobileNumber')"
               value="" ng-model="phone1" ng-required="currStep==2"
            ng-pattern="phoneRegex">
        <p class="error ng-hide" ng-show="staffForm.phone1.$touched && staffForm.phone1.$invalid">@lang('admin.staff.validation.mobileNumber')</p>
        @if($errors->has('phone1'))
            <p class="text-danger">{{ $errors->first('phone1') }}</p>
        @endif
    </div>
</div>

<!-- Enter Phone 1 Field -->
<div class="form-group {{ $errors->has('phone2') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="phone2">@lang('admin.staff.phoneNumber'):</label>
    <div class="col-md-8">
        <input type="text" id="phone2" ng-init="phone2='{{ isset($staff->phone2) ? $staff->phone2 : old('phone2') }}'" name="phone2" class="form-control" placeholder="@lang('admin.general.enter') @lang('admin.staff.phoneNumber')"
               value="" ng-model="phone2"
               ng-pattern="phoneRegex">
        <p class="error ng-hide" ng-show="staffForm.phone2.$touched && staffForm.phone2.$invalid">@lang('admin.staff.validation.phoneNumber')</p>
        @if($errors->has('phone2'))
            <p class="text-danger">{{ $errors->first('phone2') }}</p>
        @endif
    </div>
</div>

<!-- Enter Address Proof Type Field -->
<div class="form-group {{ $errors->has('address_proof_id') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="address_proof_id">Select @lang('admin.staff.addressProofType'): <span class="error">*</span></label>
    <div class="col-md-8">
        <select name="address_proof_id" ng-init="address_proof_id='{{isset($staff->address_proof_id) ? $staff->address_proof_id : old('address_proof_id')}}'" id="address_proof_id" class="form-control" ng-model="address_proof_id"  ng-required="currStep==2">
            <option value="">--- @lang('admin.general.select') @lang('admin.staff.addressProofType') ---</option>
            @php
                $sel = isset($staff->address_proof_id) ? $staff->address_proof_id : old('address_proof_id');
            @endphp
            @if(!empty($addressProofList))
                @foreach($addressProofList as $id => $name)
                    <option value="{{$id}}" {{ $sel == $id ? 'selected' : '' }}>{{$name}}</option>
                @endforeach
            @endif
        </select>
        <p class="error ng-hide" ng-show="staffForm.address_proof_id.$touched && staffForm.address_proof_id.$invalid">@lang('admin.staff.validation.addressProofType')</p>
        @if($errors->has('address_proof_id'))
            <p class="text-danger">{{ $errors->first('address_proof_id') }}</p>
        @endif
    </div>
</div>

<!-- Enter address proof number Field -->
<div class="form-group {{ $errors->has('address_proof_number') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="address_proof_number">@lang('admin.staff.addressProofNumber'): <span class="error">*</span></label>
    <div class="col-md-8">
        <input type="text" id="address_proof_number" ng-model="address_proof_number"  ng-required="currStep==2" ng-init="address_proof_number='{{isset($staff->address_proof_number) ? $staff->address_proof_number : old('address_proof_number')}}'" name="address_proof_number" class="form-control" placeholder="@lang('admin.general.enter') @lang('admin.staff.addressProofNumber')" value="{{ isset($staff->address_proof_number) ? $staff->address_proof_number : old('address_proof_number') }}">
        <p class="error ng-hide" ng-show="staffForm.address_proof_number.$touched && staffForm.address_proof_number.$invalid">@lang('admin.staff.validation.addressProofNumber')</p>
        @if($errors->has('address_proof_number'))
            <p class="text-danger">{{ $errors->first('address_proof_number') }}</p>
        @endif
    </div>
</div>

<!-- document -->
<div class="form-group">
    <label class="col-md-3 control-label" for="display_name">@lang('admin.staff.document'): <span class="error">*</span></label>
    <div class="col-md-8">
        @if(!empty($staff))
        <img src="https://dummyimage.com/110x110/000/fff&text=+Document" alt="" style="margin-bottom:10px;">
        @endif
        <input type="file" id="document" name="document" class="form-control" data-file
               value="" ng-model="document" ng-required="currStep==2 && !isEditMode" >
        <p class="error ng-hide" ng-show="staffForm.document.$touched && staffForm.document.$invalid">@lang('admin.staff.validation.document')</p>
        @if($errors->has('document'))
            <p class="text-danger">{{ $errors->first('document') }}</p>
        @endif
    </div>
</div>
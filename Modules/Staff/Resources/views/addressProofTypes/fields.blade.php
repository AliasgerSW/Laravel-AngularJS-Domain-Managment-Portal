<!-- Address Proof Name-->
<div class="form-group {{ $errors->has('proof_name') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="proof_name">@lang('admin.AddressProofType.name'): <span class="error">*</span></label>
    <div class="col-md-8"
         ng-init="proof_name='{{ isset( $addressProofType->proof_name) ? $addressProofType->proof_name : old('proof_name') }}'">
        <input type="text" id="proof_name" name="proof_name" class="form-control" placeholder="Enter Address Proof Name"
               ng-model="proof_name" maxlength="30" required>
        @if($errors->has('proof_name'))
            <p class="text-danger">{{ $errors->first('proof_name') }}</p>
        @endif
    </div>
</div>

<!-- Address Proof Description -->
<div class="form-group {{ $errors->has('proof_descr') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="proof_descr">@lang('admin.AddressProofType.description'):</label>
    <div class="col-md-8">
        <textarea id="proof_descr" name="proof_descr" class="form-control" ng-model="proof_descr"
                  placeholder="Enter Description" maxlength="200" rows="5" ng-init="proof_descr='{{ isset( $addressProofType->proof_descr) ? $addressProofType->proof_descr : old('proof_descr') }}'">
            {{ isset($addressProofType->proof_descr) ? $addressProofType->proof_descr : old('proof_descr') }}</textarea>
        @if($errors->has('proof_descr'))
            <p class="text-danger">{{ $errors->first('proof_descr') }}</p>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('accepted_at') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="accepted_at">@lang('admin.AddressProofType.accepted_at'):</label>
    <div class="col-md-8">
        <select name="accepted_at[]" id="accepted_at" class="form-control" multiple="multiple">
            <option value="">--- Select Countries ---</option>
            @php
                $sel = isset($addressProofType->accepted_at) ? $addressProofType->accepted_at : old('accepted_at');
            @endphp
            @if(!empty($countriesList))
                @foreach($countriesList as $id => $name)
                    <option value="{{$id}}" {{ !empty($sel) && in_array($id, $sel) ? 'selected' : '' }}>{{$name}}</option>
                @endforeach
            @endif
        </select>
        @if($errors->has('accepted_at'))
            <p class="text-danger">{{ $errors->first('accepted_at') }}</p>
        @endif
    </div>
</div>
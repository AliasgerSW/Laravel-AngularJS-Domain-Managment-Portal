
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="first_name">@lang('admin.user.first_name')</label>
            <input type="text" name="first_name" required class="form-control" placeholder="First Name">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="middle_name">@lang('admin.user.middle_name')</label>
            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="last_name">@lang('admin.user.last_name')</label>
            <input type="text" name="last_name" required placeholder="Last Name" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">@lang('admin.user.email')</label>
            <input type="email" name="email" placeholder="jhon@doe.com" class="form-control" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">@lang('admin.user.confirm_email')</label>
            <input type="email" name="confirm_email" placeholder="jhon@doe.com" class="form-control" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">@lang('admin.user.password')</label>
            <input type="password" name="password" class="form-control"required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="confirm_password">@lang('admin.user.confirm_password')</label>
            <input type="password" name="confirm_password" class="form-control"required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="country" >@lang('admin.user.select_country')</label>
            <select name="country" id="countryid" class="form-control" >
                <option value="">Select Country</option>
                @if($countries->count() > 0)
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                @endif

            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="states">@lang('admin.user.select_state')</label>
            <select name="state" id="stateid" class="form-control">
                <option value="">Select State</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="postal_code">@lang('admin.user.postal_address')</label>
        <input type="text" name="postal_code" required class="form-control">
    </div>
    <div class="col-md-6">
        <label for="city">@lang('admin.user.select_city')</label>
        <select name="city" id="cityid" class="form-control">
            <option value="">Select City</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="address">@lang('admin.user.address')</label>
            <textarea name="address" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="tel_number">@lang('admin.user.tel_number')</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="alt_tel_number">@lang('admin.user._alternate_tel_number')</label>
            <input type="text" name="alternative_tel_num" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="mobile_number">@lang('admin.user.mobile_number')</label>
            <input type="text" name="mobile" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="fax_number">@lang('admin.user.fax_number')</label>
            <input type="text" class="form-control" name="fax">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="alt_email">@lang('admin.user.alternate_email')</label>
            <input type="email" class="form-control" name="alternative_email">
        </div>
    </div>


</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="notes">@lang('admin.user.notes')</label>
            <textarea name="notes" id="" class="form-control" cols="30" rows="10"></textarea>
        </div>
    </div>
</div>
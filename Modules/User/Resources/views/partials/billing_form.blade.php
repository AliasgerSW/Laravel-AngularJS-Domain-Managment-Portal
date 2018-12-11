<h2 style="text-align: center">Billing Info</h2>

<div class="row">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">@lang('admin.user.first_name')</label>
                <input id="billing_first_name" type="hidden" name="billing_first_name" required class="form-control" placeholder="First Name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="middle_name">@lang('admin.user.middle_name')</label>
                <input type="text" name="billing_middle_name" class="form-control" placeholder="Middle Name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="last_name">@lang('admin.user.last_name')</label>
                <input id="billing_last_name" type="hidden" name="billing_last_name" required placeholder="Last Name" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">@lang('admin.user.email')</label>
                <input id="billing_email" type="hidden" name="billing_email" placeholder="jhon@doe.com" class="form-control" required>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="country">@lang('admin.user.select_country')</label>
                <select name="billing_country" id="" class="form-control">
                    <option value="pakistan">Pakistan</option>
                    <option value="india">India</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="billing_states">@lang('admin.user.select_state')</label>
                <select name="billing_state" id="" class="form-control">
                    <option value="state1">State1</option>
                    <option value="state2">State2</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="billing_postal_code">@lang('admin.user.postal_code')</label>
            <input id="billing_postal_code" type="hidden" name="billing_postal_code" required class="form-control">
        </div>
        <div class="col-md-6">
            <label for="city">@lang('admin.user.select_city')</label>
            <select name="billing_city" id="" class="form-control">
                <option value="city1">City1</option>
                <option value="city2">City2</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="address">@lang('admin.user.address')</label>
                <input type="hidden" name="billing_address" id="billing_address" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tel_number">@lang('admin.user.tel_number')</label>
                <input id="billing_phone" type="hidden" name="billing_phone" class="form-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="fax_number">@lang('admin.user.fax_number')</label>
                <input  type="text" class="form-control" name="billing_fax">
            </div>
        </div>

    </div>




    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="notes">@lang('admin.user.notes')</label>
                <textarea name="billing_notes" id="" class="form-control" cols="30" rows="10"></textarea>
            </div>
        </div>
    </div>



</div>
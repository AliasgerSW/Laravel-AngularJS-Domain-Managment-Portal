<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = ['customer_id', 'domain_id', 'type', 'first_name', 'last_name', 'middle_name', 'phone', 'alternative_tel_num', 'mobile', 'alternative_email', 'country', 'org_name', 'state', 'city',	'address1', 'address2', 'address3', 'postal_code', 'fax', 'notes', 'account_holder_position', 'account_holder_first_name', 'account_holder_last_name', 'email', 'fax_code', 'phone_code'];

    protected $dates = ['deleted_at'];

    public static $types = ['default','technical','admin','billing'];
}

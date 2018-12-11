<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\GEO\Entities\City;
use Modules\GEO\Entities\Country;
use Modules\GEO\Entities\State;

class Staff extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'email',
        'p_email',
        'user_level',
        'country_id',
        'state_id',
        'city_id',
        'zipcode',
        'address1',
        'address2',
        'address3',
        'phone1',
        'phone2',
        'address_proof_id',
        'address_proof_number',
        'username',
        'position',
        'shift_timings',
        'profile_image',
        'display_name',
        'interest',
        'skills',
        'language',
        'about_me',
        'created_by',
        'status',
        'staff_position_id',
        'document',
        'password'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function address_proof()
    {
        return $this->belongsTo(address_proof_types::class);
    }

    public function position()
    {
        return $this->belongsTo(staff_positions::class, 'position');
    }

    public function shift_timings()
    {
        return $this->belongsTo(staff_shifts::class, 'shift_timings');
    }

    public function addressProofType()
    {
        return $this->belongsTo(AddressProofTypes::class, 'staff_position_id');
    }

}

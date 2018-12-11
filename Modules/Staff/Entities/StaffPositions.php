<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;

class StaffPositions extends Model
{
    protected $fillable = [
        'position_name',
        'position_code'
    ];

    protected $table = 'staff_positions';

}

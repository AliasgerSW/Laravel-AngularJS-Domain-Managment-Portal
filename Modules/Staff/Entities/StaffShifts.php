<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;

class StaffShifts extends Model
{
    protected $fillable = [
        'shift_name',
        'shift_descr',
        'start_from',
        'ends_at',
    ];
}

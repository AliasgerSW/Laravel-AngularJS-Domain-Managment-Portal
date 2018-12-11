<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerContact extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'resellerclub_client_id'];

    protected $dates = ['deleted_at'];
}

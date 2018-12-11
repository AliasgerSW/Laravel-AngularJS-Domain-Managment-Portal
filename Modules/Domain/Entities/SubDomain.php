<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDomain extends Model
{
    use SoftDeletes;

    protected $fillable = ['domain_id', 'name'];

    protected $dates = ['deleted_at'];

    public $table = "subdomains";
}

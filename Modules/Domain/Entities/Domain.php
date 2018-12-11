<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','sequence','feature','is_active_for_sale','registrar','cost_price','privacy_protection_reason','gdpr_protection'];

    protected $dates = ['deleted_at'];
}

<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;

class PaymentConfig extends Model
{
    protected $fillable = ['method_name','percent','amount','status'];
}

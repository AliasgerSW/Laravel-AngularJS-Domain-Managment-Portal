<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DNSRecord extends Model
{
    use SoftDeletes;

    protected $fillable = ['type', 'domain_id', 'record_id', 'hostname', 'value', 'status', 'ttl', 'value_type', 'class', 'mx_priority', 'weight', 'port'];

    protected $dates = ['deleted_at'];

    public $table = "dns_records";
}

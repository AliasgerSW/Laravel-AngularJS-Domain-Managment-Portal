<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DomainDNS extends Model
{
    use SoftDeletes;

    protected $fillable = ['domain_id','a_record','aaaa_record','max_record','cname_record','ns_record','txt_record','srv_record','soa_record', 'child_ns_record', 'dnssec_record'];

    protected $dates = ['deleted_at'];

    public $table = "domain_dns_records";
}

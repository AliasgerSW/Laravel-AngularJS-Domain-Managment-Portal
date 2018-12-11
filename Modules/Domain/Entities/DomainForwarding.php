<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DomainForwarding extends Model
{
    use SoftDeletes;

    protected $fillable = ['domain_id', 'subdomain_id', 'source', 'destination_protocol', 'destination_url', 'url_masking', 'header_tags', 'page_content', 'path_forwarding', 'sub_domain_forwarding'];

    protected $dates = ['deleted_at'];

    public $table = "domain_forwarding";
}

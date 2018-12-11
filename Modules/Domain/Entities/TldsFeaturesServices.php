<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TldsFeaturesServices extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'tld_id',
        'dns_cost_price',
        'dns_service_type',
        'dns_price',
        'dns_act_free',
        'dns_duration',
        'is_dns_active',
        'privacy_protection_cost_price',
        'privacy_protection_service_type',
        'privacy_protection_price',
        'privacy_protection_activation_fee',
        'privacy_protection_duration',
        'is_privacy_protection_active',
        'theft_protection_price',
        'is_theft_protection_active',
        'theft_protection_service_type',
        'theft_protection_duration',
        'theft_protection_cost_price',
        'theft_protection_activation_fee',
        'child_name_server_price',
        'is_child_name_server_active',
        'child_name_server_service_type',
        'child_name_server_duration',
        'child_name_server_cost_price',
        'child_name_server_activation_fee',
        'is_domain_secret_active',
        'domain_secret_price',
        'domain_secret_service_type',
        'domain_secret_duration',
        'domain_secret_cost_price',
        'domain_secret_activation_fee',
        'is_domain_forwarding_active',
        'domain_forwarding_price',
        'domain_forwarding_service_type',
        'domain_forwarding_duration',
        'domain_forwarding_cost_price',
        'domain_forwarding_activation_fee',
        'is_name_server_active',
        'name_server_price',
        'name_server_service_type',
        'name_server_duration',
        'name_server_cost_price',
        'name_server_activation_fee',
        'is_wap_active',
        'wap_price',
        'wap_service_type',
        'wap_duration',
        'wap_cost_price',
        'wap_activation_fee',
        'is_chat_active',
        'chat_price',
        'chat_service_type',
        'chat_duration',
        'chat_cost_price',
        'chat_activation_fee',
        'is_free_email_active',
        'free_email_price',
        'free_email_service_type',
        'free_email_duration',
        'free_email_cost_price',
        'free_email_activation_fee',
        'gdrp_protection_active',
        'gdrp_protection_price',
        'gdrp_protection_service_type',
        'gdrp_protection_duration',
        'gdrp_protection_cost_price',
        'gdrp_protection_activation_fee',
        'dnssec_active',
        'dnssec_price',
        'dnssec_service_type',
        'dnssec_duration',
        'dnssec_cost_price',
        'dnssec_activation_fee',
        'min_nameserver_limit',
        'max_nameserver_limit'
        ];

    public function  tld()
    {
        return $this->belongsTo(Tld::class);
    }
}

<?php

namespace Modules\ResellerClub\API;

class RequestFactory
{
    public static $RequestRoutes = [
        'lookupdomain' => 'Modules\ResellerClub\API\Domain\Lookup\LookupDomain',
        'getprice' => 'Modules\ResellerClub\API\Domain\Lookup\GetPrice',
        'categorykeymapping' => 'Modules\ResellerClub\API\Category\CategoryKeyMapping',
        'gettlds'      => 'Modules\ResellerClub\API\Domain\Lookup\GetTlds',
        'enable-gdpr-protection'  => 'Modules\ResellerClub\API\Domain\Protection\GdprProtection\EnableGdprProtection',
        'disable-gdpr-protection'  => 'Modules\ResellerClub\API\Domain\Protection\GdprProtection\DisableGdprProtection',
        'modify-domain-secret'  => 'Modules\ResellerClub\API\Domain\Protection\ModifyDomainSecret',
        'enable-theft-protection' => 'Modules\ResellerClub\API\Domain\Protection\TheftProtection\EnableTheftProtection',
        'disable-theft-protection' => 'Modules\ResellerClub\API\Domain\Protection\TheftProtection\DisableTheftProtection',
        'privacy-protection' => 'Modules\ResellerClub\API\Domain\Protection\PrivacyProtection',
        'add-contact' => 'Modules\ResellerClub\API\Contact\AddContact',
        'delete-contact' => 'Modules\ResellerClub\API\Contact\DeleteContact',
        'get-contact' => 'Modules\ResellerClub\API\Contact\GetContact',
        'modify-name-server' => 'Modules\ResellerClub\API\Domain\NameServer\ModifyNameServer',
        'add-child-name-server' => 'Modules\ResellerClub\API\Domain\NameServer\ChildNameServer\AddChildNameServer',
        'delete-child-name-server' => 'Modules\ResellerClub\API\Domain\NameServer\ChildNameServer\DeleteChildNameServer',
        'modify-child-name-server-host' => 'Modules\ResellerClub\API\Domain\NameServer\ChildNameServer\ModifyChildNameServerHost',
        'modify-child-name-server-ip' => 'Modules\ResellerClub\API\Domain\NameServer\ChildNameServer\ModifyChildNameServerIP',
        'activate-domain-forwarding' => 'Modules\ResellerClub\API\Domain\DomainForwarding\ActivateDomainForwarding',
        'modify-domain-forwarding' => 'Modules\ResellerClub\API\Domain\DomainForwarding\ModifyDomainForwarding',
        'activate-free-email' => 'Modules\ResellerClub\API\Domain\FreeEmail\ActivateFreeEmail',
        'add-email-user-account' => 'Modules\ResellerClub\API\Domain\FreeEmail\AddEmailUserAccount',
        'add-email-user-forward-only-account' => 'Modules\ResellerClub\API\Domain\FreeEmail\AddForwardOnlyAccount',
        'get-email-user'    => 'Modules\ResellerClub\API\Domain\FreeEmail\GetEmailUser',
        'modify-email-user'    => 'Modules\ResellerClub\API\Domain\FreeEmail\ModifyEmailUser',
        'suspend-email-user'    => 'Modules\ResellerClub\API\Domain\FreeEmail\SuspendEmailUser',
        'delete-email-user'    => 'Modules\ResellerClub\API\Domain\FreeEmail\DeleteEmailUser',
        'change-email-user-password'    => 'Modules\ResellerClub\API\Domain\FreeEmail\ChangeEmailUesrPassword',
        'activate-dns-service' => 'Modules\ResellerClub\API\DNS\ActivateDnsService',
        'add-mx-record' => 'Modules\ResellerClub\API\DNS\MX\AddMxRecord',
        'modify-mx-record' => 'Modules\ResellerClub\API\DNS\MX\ModifyMxRecord',
        'delete-mx-record' => 'Modules\ResellerClub\API\DNS\MX\DeleteMxRecord',
        'add-txt-record' => 'Modules\ResellerClub\API\DNS\TXT\AddTxtRecord',
        'modify-txt-record' => 'Modules\ResellerClub\API\DNS\TXT\ModifyTxtRecord',
        'delete-txt-record' => 'Modules\ResellerClub\API\DNS\TXT\DeleteTxtRecord',
        'modify-soa-record' => 'Modules\ResellerClub\API\DNS\SOA\ModifySoaRecord',
        'add-cname-record' => 'Modules\ResellerClub\API\DNS\CNAME\AddCnameRecord',
        'delete-cname-record' => 'Modules\ResellerClub\API\DNS\CNAME\DeleteCnameRecord',
        'modify-cname-record' => 'Modules\ResellerClub\API\DNS\CNAME\ModifyCnameRecord',
        'add-ipv4-record' => 'Modules\ResellerClub\API\DNS\IPV4\AddIpV4Record',
        'delete-ipv4-record' => 'Modules\ResellerClub\API\DNS\IPV4\DeleteIpV4Record',
        'modify-ipv4-record' => 'Modules\ResellerClub\API\DNS\IPV4\ModifyIpV4Record',
        'add-ipv6-record' => 'Modules\ResellerClub\API\DNS\IPV6\AddIpV6Record',
        'delete-ipv6-record' => 'Modules\ResellerClub\API\DNS\IPV6\DeleteIpV6Record',
        'modify-ipv6-record' => 'Modules\ResellerClub\API\DNS\IPV6\ModifyIpV6Record',
        'add-srv-record' => 'Modules\ResellerClub\API\DNS\SRV\AddSrvRecord',
        'delete-srv-record' => 'Modules\ResellerClub\API\DNS\SRV\DeleteSrvRecord',
        'modify-srv-record' => 'Modules\ResellerClub\API\DNS\SRV\ModifySrvRecord',
        'search-dns-record' => 'Modules\ResellerClub\API\DNS\SearchDnsRecord',
        'get-privacy-protection-price' => 'Modules\ResellerClub\API\Price\PrivacyProtectionPrice',
        'add-dnssec-record' => 'Modules\ResellerClub\API\DNS\DNSSEC\AddDnsSecRecord',
        'delete-dnssec-record' => 'Modules\ResellerClub\API\DNS\DNSSEC\DeleteDnsSecRecord',
        'add-customer' => 'Modules\ResellerClub\API\Customer\AddCustomer',
        'modify-customer' => 'Modules\ResellerClub\API\Customer\ModifyCustomer',
        'delete-customer' => 'Modules\ResellerClub\API\Customer\DeleteCustomer',
        'get-customer-by-username' => 'Modules\ResellerClub\API\Customer\GetCustomerByUsername',
        'get-customer-by-id' => 'Modules\ResellerClub\API\Customer\GetCustomerById',
        'change-customer-password' => 'Modules\ResellerClub\API\Customer\ChangeCustomerPassword',
        'renew-domain' => 'Modules\ResellerClub\API\Domain\Registration\RenewDomain',
        'transfer-domain' => 'Modules\ResellerClub\API\Domain\Registration\TransferDomain',
        'register-new-domain' => 'Modules\ResellerClub\API\Domain\Registration\RegisterNewDomain',
        'delete-domain' => 'Modules\ResellerClub\API\Domain\Registration\DeleteDomain',
        'restore-domain' => 'Modules\ResellerClub\API\Domain\Registration\RestoreDomain',
        'add-ns-record' => 'Modules\ResellerClub\API\DNS\NS\AddNsRecord',
        'modify-ns-record' => 'Modules\ResellerClub\API\DNS\NS\ModifyNsRecord',
        'delete-ns-record' => 'Modules\ResellerClub\API\DNS\NS\DeleteNsRecord',
        'lock-order' => 'Modules\ResellerClub\API\Order\Lock',
        'suspend-order' => 'Modules\ResellerClub\API\Order\Suspend',
        'unlock-order' => 'Modules\ResellerClub\API\Order\UnLock',
        'unsuspend-order' => 'Modules\ResellerClub\API\Order\UnSuspend',
        'search-domain' => 'Modules\ResellerClub\API\Domain\Registration\Search',

    ];

    public static function build($func, $dataObject)
    {
        $route = '';
        $routeKey = strtolower($func);
        unset($dataObject->func);
        if (array_key_exists($routeKey, self::$RequestRoutes)) {
            $route = self::$RequestRoutes[$routeKey];
        }
        $class =$route;
        if (class_exists($class)) {
            return new $class($dataObject);
        } else {
            throw new \Exception("This function is not supported");
        }
    }
}
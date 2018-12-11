<?php


namespace Modules\ResellerClub\API\DNS\IPV6;


use Modules\ResellerClub\API\ResellerClub;

class ModifyIpV6Record extends ResellerClub
{
    public $action = 'modify-ipv6-record';
    public $url = 'dns/manage/update-ipv6-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'current-value',
            'new-value',
        ]
    ];
    public $optionalFields = [
        'attributes' => [
            'host',
            'ttl',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
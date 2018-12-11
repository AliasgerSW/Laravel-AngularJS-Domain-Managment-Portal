<?php


namespace Modules\ResellerClub\API\DNS\IPV4;


use Modules\ResellerClub\API\ResellerClub;

class ModifyIpV4Record extends ResellerClub
{
    public $action = 'modify-ipv4-record';
    public $url = 'dns/manage/update-ipv4-record';
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
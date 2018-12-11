<?php


namespace Modules\ResellerClub\API\DNS\IPV6;


use Modules\ResellerClub\API\ResellerClub;

class AddIpV6Record extends ResellerClub
{
    public $action = 'add-ipv6-record';
    public $url = 'dns/manage/add-ipv6-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'value',
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
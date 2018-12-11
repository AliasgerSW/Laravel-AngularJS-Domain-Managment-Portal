<?php


namespace Modules\ResellerClub\API\DNS\IPV4;


use Modules\ResellerClub\API\ResellerClub;

class AddIpV4Record extends ResellerClub
{
    public $action = 'add-ipv4-record';
    public $url = 'dns/manage/add-ipv4-record';
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
<?php


namespace Modules\ResellerClub\API\DNS\SRV;


use Modules\ResellerClub\API\ResellerClub;

class AddSrvRecord extends ResellerClub
{
    public $action = 'add-srv-record';
    public $url = 'dns/manage/add-srv-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'value',
            'host',
        ]
    ];

    public $optionalFields = [
        'attributes' => [
            'ttl',
            'priority',
            'port',
            'weight',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
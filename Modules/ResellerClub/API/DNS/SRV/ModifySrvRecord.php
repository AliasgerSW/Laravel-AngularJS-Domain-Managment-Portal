<?php


namespace Modules\ResellerClub\API\DNS\SRV;


use Modules\ResellerClub\API\ResellerClub;

class ModifySrvRecord extends ResellerClub
{
    public $action = 'modify-srv-record';
    public $url = 'dns/manage/update-srv-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'current-value',
            'new-value',
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
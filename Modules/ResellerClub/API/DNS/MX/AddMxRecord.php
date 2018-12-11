<?php


namespace Modules\ResellerClub\API\DNS\MX;


use Modules\ResellerClub\API\ResellerClub;

class AddMxRecord extends ResellerClub
{
    public $action = 'add-mx-record';
    public $url = 'dns/manage/add-mx-record';
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
            'priority',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }
}
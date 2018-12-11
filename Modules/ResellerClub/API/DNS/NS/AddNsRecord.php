<?php


namespace Modules\ResellerClub\API\DNS\NS;


use Modules\ResellerClub\API\ResellerClub;

class AddNsRecord extends ResellerClub
{
    public $action = 'add-ns-record';
    public $url = 'dns/manage/add-ns-record';
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
<?php


namespace Modules\ResellerClub\API\DNS\CNAME;


use Modules\ResellerClub\API\ResellerClub;

class AddCnameRecord extends ResellerClub
{
    public $action = 'add-cname-record';
    public $url = 'dns/manage/add-cname-record';
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
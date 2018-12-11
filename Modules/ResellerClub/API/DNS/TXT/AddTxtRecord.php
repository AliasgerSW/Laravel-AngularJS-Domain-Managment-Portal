<?php


namespace Modules\ResellerClub\API\DNS\TXT;


use Modules\ResellerClub\API\ResellerClub;

class AddTxtRecord extends ResellerClub
{
    public $action = 'add-txt-record';
    public $url = 'dns/manage/add-txt-record';
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
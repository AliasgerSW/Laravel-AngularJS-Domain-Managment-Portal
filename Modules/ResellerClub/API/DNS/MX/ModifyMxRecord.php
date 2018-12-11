<?php


namespace Modules\ResellerClub\API\DNS\MX;


use Modules\ResellerClub\API\ResellerClub;

class ModifyMxRecord extends ResellerClub
{
    public $action = 'modify-mx-record';
    public $url = 'dns/manage/update-mx-record';
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
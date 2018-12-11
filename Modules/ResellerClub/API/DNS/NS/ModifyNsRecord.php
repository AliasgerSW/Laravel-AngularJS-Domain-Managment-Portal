<?php


namespace Modules\ResellerClub\API\DNS\NS;


use Modules\ResellerClub\API\ResellerClub;

class ModifyNsRecord extends ResellerClub
{
    public $action = 'modify-ns-record';
    public $url = 'dns/manage/update-ns-record';
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
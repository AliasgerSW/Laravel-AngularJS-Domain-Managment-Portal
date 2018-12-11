<?php


namespace Modules\ResellerClub\API\DNS\CNAME;


use Modules\ResellerClub\API\ResellerClub;

class ModifyCnameRecord extends ResellerClub
{
    public $action = 'modify-cname-record';
    public $url = 'dns/manage/update-cname-record';
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
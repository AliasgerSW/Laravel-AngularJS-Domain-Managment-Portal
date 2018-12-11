<?php


namespace Modules\ResellerClub\API\DNS\SOA;


use Modules\ResellerClub\API\ResellerClub;

class ModifySoaRecord extends ResellerClub
{
    public $action = 'modify-soa-record';
    public $url = 'dns/manage/update-soa-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'responsible-person',
            'refresh',
            'retry',
            'expire',
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
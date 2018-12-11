<?php


namespace Modules\ResellerClub\API\DNS\SRV;


use Modules\ResellerClub\API\ResellerClub;

class DeleteSrvRecord extends ResellerClub
{
    public $action = 'delete-srv-record';
    public $url = 'dns/manage/delete-srv-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'value',
            'host',
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
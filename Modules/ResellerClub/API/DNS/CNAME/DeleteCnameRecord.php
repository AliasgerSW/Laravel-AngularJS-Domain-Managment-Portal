<?php


namespace Modules\ResellerClub\API\DNS\CNAME;


use Modules\ResellerClub\API\ResellerClub;

class DeleteCnameRecord extends ResellerClub
{
    public $action = 'delete-cname-record';
    public $url = 'dns/manage/delete-cname-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'host',
            'value',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
<?php


namespace Modules\ResellerClub\API\DNS\MX;


use Modules\ResellerClub\API\ResellerClub;

class DeleteMxRecord extends ResellerClub
{
    public $action = 'delete-mx-record';
    public $url = 'dns/manage/delete-mx-record';
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
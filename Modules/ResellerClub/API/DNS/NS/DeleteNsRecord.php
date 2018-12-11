<?php


namespace Modules\ResellerClub\API\DNS\NS;


use Modules\ResellerClub\API\ResellerClub;

class DeleteNsRecord extends ResellerClub
{
    public $action = 'delete-ns-record';
    public $url = 'dns/manage/delete-ns-record';
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
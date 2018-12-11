<?php


namespace Modules\ResellerClub\API\DNS\TXT;


use Modules\ResellerClub\API\ResellerClub;

class DeleteTxtRecord extends ResellerClub
{
    public $action = 'delete-txt-record';
    public $url = 'dns/manage/delete-txt-record';
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
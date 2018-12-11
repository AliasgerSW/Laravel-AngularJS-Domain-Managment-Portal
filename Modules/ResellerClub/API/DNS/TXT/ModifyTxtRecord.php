<?php


namespace Modules\ResellerClub\API\DNS\TXT;


use Modules\ResellerClub\API\ResellerClub;

class ModifyTxtRecord extends ResellerClub
{
    public $action = 'modify-txt-record';
    public $url = 'dns/manage/update-txt-record';
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
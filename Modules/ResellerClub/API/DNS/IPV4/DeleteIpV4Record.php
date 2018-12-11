<?php


namespace Modules\ResellerClub\API\DNS\IPV4;


use Modules\ResellerClub\API\ResellerClub;

class DeleteIpV4Record extends ResellerClub
{
    public $action = 'delete-ipv4-record';
    public $url = 'dns/manage/delete-ipv4-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'value',
        ]
    ];
    public $optionalFields = [
        'attributes' => [
            'host',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
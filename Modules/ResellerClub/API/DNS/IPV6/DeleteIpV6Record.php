<?php


namespace Modules\ResellerClub\API\DNS\IPV6;


use Modules\ResellerClub\API\ResellerClub;

class DeleteIpV6Record extends ResellerClub
{
    public $action = 'delete-ipv6-record';
    public $url = 'dns/manage/delete-ipv6-record';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'value',
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
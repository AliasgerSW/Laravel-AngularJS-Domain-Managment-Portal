<?php


namespace Modules\ResellerClub\API\DNS;


use Modules\ResellerClub\API\ResellerClub;

class SearchDnsRecord extends ResellerClub
{
    public $action = 'search-dns-record';
    public $url = 'dns/manage/search-records';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'type',
            'no-of-records',
            'page-no',

        ]
    ];

    public $optionalFields = [
        'attributes' => [
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
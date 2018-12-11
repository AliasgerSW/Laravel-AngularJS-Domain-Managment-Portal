<?php


namespace Modules\ResellerClub\API\DNS\DNSSEC;


use Modules\ResellerClub\API\ResellerClub;

class DeleteDnsSecRecord extends ResellerClub
{
    public $action = 'delete-dnssec-record';

    public $url = 'domains/del-dnssec';

    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'attr-name1',
            'attr-value1',
            'attr-name2',
            'attr-value2',
            'attr-name3',
            'attr-value3',
            'attr-name4',
            'attr-value4',
        ],
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
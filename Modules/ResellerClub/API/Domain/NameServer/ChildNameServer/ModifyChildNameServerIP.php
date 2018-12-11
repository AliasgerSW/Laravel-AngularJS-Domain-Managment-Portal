<?php


namespace Modules\ResellerClub\API\Domain\NameServer\ChildNameServer;


use Modules\ResellerClub\API\ResellerClub;

class ModifyChildNameServerIP extends ResellerClub
{
    public $action = 'modify-child-name-server-ip';
    public $url = 'domains/modify-cns-ip';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'cns',
            'old-ip',
            'new-ip',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
<?php


namespace Modules\ResellerClub\API\Domain\NameServer\ChildNameServer;


use Modules\ResellerClub\API\ResellerClub;

class ModifyChildNameServerHost extends ResellerClub
{
    public $action = 'modify-child-name-server-host';
    public $url = 'domains/modify-cns-name';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'old-cns',
            'new-cns',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
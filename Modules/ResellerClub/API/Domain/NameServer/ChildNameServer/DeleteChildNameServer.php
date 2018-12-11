<?php


namespace Modules\ResellerClub\API\Domain\NameServer\ChildNameServer;


use Modules\ResellerClub\API\ResellerClub;

class DeleteChildNameServer extends ResellerClub
{
    public $action = 'delete-child-name-server';
    public $url = 'domains/delete-cns-ip';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'cns',
            'ip',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
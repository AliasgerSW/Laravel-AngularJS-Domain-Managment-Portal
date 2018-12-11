<?php


namespace Modules\ResellerClub\API\Domain\NameServer\ChildNameServer;


use Modules\ResellerClub\API\ResellerClub;

class AddChildNameServer extends ResellerClub
{
    public $action = 'add-child-name-server';
    public $url = 'domains/add-cns';
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
<?php


namespace Modules\ResellerClub\API\Domain\NameServer;


use Modules\ResellerClub\API\ResellerClub;

class ModifyNameServer extends ResellerClub
{
    public $action = 'modify-name-server';
    public $url = 'domains/modify-ns';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'ns',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
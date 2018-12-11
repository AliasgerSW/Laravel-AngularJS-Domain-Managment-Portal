<?php


namespace Modules\ResellerClub\API\Order;


use Modules\ResellerClub\API\ResellerClub;

class Lock extends ResellerClub
{
    public $action = 'lock-order';

    public $url = 'domains/reseller-lock/add';

    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'reason',
        ],
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
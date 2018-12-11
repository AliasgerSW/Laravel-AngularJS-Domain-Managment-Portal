<?php


namespace Modules\ResellerClub\API\Order;


use Modules\ResellerClub\API\ResellerClub;

class Suspend extends ResellerClub
{
    public $action = 'suspend-order';

    public $url = 'orders/suspend';

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
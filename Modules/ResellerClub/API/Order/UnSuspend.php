<?php


namespace Modules\ResellerClub\API\Order;


use Modules\ResellerClub\API\ResellerClub;

class UnSuspend extends ResellerClub
{
    public $action = 'unsuspend-order';

    public $url = 'orders/unsuspend';

    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
        ],
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
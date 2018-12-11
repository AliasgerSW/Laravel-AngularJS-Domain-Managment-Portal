<?php


namespace Modules\ResellerClub\API\Order;


use Modules\ResellerClub\API\ResellerClub;

class UnLock extends ResellerClub
{
    public $action = 'unlock-order';

    public $url = 'domains/reseller-lock/remove';

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
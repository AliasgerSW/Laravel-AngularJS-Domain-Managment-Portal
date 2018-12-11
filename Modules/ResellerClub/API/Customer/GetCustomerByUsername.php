<?php

namespace Modules\ResellerClub\API\Customer;

use Modules\ResellerClub\API\ResellerClub;

class GetCustomerByUsername extends ResellerClub
{
    public $url = 'customers/details';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Get Customer By Username constructor.
     * @param $dataObject
     * @throws \Exception
     */
    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url, true);
    }
}
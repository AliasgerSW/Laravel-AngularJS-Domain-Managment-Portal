<?php

namespace Modules\ResellerClub\API\Customer;

use Modules\ResellerClub\API\ResellerClub;

class GetCustomerById extends ResellerClub
{
    public $url = 'customers/details-by-id';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Get Customer By Id constructor.
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
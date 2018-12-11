<?php

namespace Modules\ResellerClub\API\Customer;

use Modules\ResellerClub\API\ResellerClub;

class AddCustomer extends ResellerClub
{
    public $url = 'customers/v2/signup';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Add Customer constructor.
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
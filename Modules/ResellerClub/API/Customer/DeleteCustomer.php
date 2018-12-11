<?php

namespace Modules\ResellerClub\API\Customer;

use Modules\ResellerClub\API\ResellerClub;

class DeleteCustomer extends ResellerClub
{
    public $url = 'customers/delete';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Delete Customer constructor.
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
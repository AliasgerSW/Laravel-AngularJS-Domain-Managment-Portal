<?php

namespace Modules\ResellerClub\API\Customer;

use Modules\ResellerClub\API\ResellerClub;

class ChangeCustomerPassword extends ResellerClub
{
    public $url = 'customers/v2/change-password';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Change Customer Password constructor.
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
<?php

namespace Modules\ResellerClub\API\Customer;

use Modules\ResellerClub\API\ResellerClub;

class ModifyCustomer extends ResellerClub
{
    public $url = 'customers/modify';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Modify Customer constructor.
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
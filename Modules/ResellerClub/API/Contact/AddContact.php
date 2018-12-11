<?php

namespace Modules\ResellerClub\API\Contact;

use Modules\ResellerClub\API\ResellerClub;

class AddContact extends ResellerClub
{
    public $url = 'contacts/add';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Add Contact constructor.
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
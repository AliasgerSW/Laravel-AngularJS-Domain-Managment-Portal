<?php

namespace Modules\ResellerClub\API\Contact;

use Modules\ResellerClub\API\ResellerClub;

class DeleteContact extends ResellerClub
{
    public $url = 'contacts/delete';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Delete Contact constructor.
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
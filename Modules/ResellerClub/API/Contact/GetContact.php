<?php

namespace Modules\ResellerClub\API\Contact;

use Modules\ResellerClub\API\ResellerClub;

class GetContact extends ResellerClub
{
    public $url = 'contacts/details';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Get Contact constructor.
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
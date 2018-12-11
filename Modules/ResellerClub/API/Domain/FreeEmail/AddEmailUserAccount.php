<?php

namespace Modules\ResellerClub\API\Domain\FreeEmail;

use Modules\ResellerClub\API\ResellerClub;

class AddEmailUserAccount extends  ResellerClub
{
    public $url = 'mail/user/add';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Add Email User Account constructor.
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
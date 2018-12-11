<?php

namespace Modules\ResellerClub\API\Domain\FreeEmail;

use Modules\ResellerClub\API\ResellerClub;

class AddForwardOnlyAccount extends  ResellerClub
{
    public $url = 'mail/user/add-forward-only-account';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Add Email User Forward Only Account constructor.
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
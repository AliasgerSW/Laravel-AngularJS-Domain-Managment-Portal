<?php

namespace Modules\ResellerClub\API\Domain\FreeEmail;

use Modules\ResellerClub\API\ResellerClub;

class ModifyEmailUser extends  ResellerClub
{
    public $url = 'mail/user/modify';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Modify Email User constructor.
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
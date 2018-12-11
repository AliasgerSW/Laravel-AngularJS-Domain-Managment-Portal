<?php

namespace Modules\ResellerClub\API\Domain\FreeEmail;

use Modules\ResellerClub\API\ResellerClub;

class ActivateFreeEmail extends  ResellerClub
{
    public $url = 'mail/activate';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Activate Domain Forwarding constructor.
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
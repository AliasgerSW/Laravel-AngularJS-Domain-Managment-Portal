<?php

namespace Modules\ResellerClub\API\Domain\DomainForwarding;

use Modules\ResellerClub\API\ResellerClub;

class ModifyDomainForwarding extends  ResellerClub
{
    public $url = 'domainforward/manage';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * Modify Domain Forwarding constructor.
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
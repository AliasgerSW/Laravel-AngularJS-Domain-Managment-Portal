<?php

namespace Modules\ResellerClub\API\Domain\Lookup;

use Modules\ResellerClub\API\ResellerClub;

class LookupDomain extends ResellerClub
{
    public $action = 'lookupdomain';
    public $url = 'domains/available';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'tlds',
        ],
    ];

    /**
     * LookUpDomain constructor.
     * @param $dataObject
     * @throws \Exception
     */
    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
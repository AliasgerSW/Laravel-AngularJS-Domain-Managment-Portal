<?php


namespace Modules\OpenSRS\API\Domain\Lookup;


use Modules\OpenSRS\API\OpenSrs;

class LookUpDomain extends OpenSrs
{
    public $action = 'lookup';
    public $object = 'domain';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain',
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
        $this->send($dataObject);

    }

}
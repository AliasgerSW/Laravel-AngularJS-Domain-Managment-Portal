<?php


namespace Modules\OpenSRS\API\Domain\Lookup;


use Modules\OpenSRS\API\OpenSrs;

class GetPrice extends OpenSrs
{
    public $action = 'get_price';
    public $object = 'domain';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain',
        ],
    ];

    public function __construct($dataObject)
    {
        parent::__construct();

        $this->validateDataObject($dataObject);
        $this->send($dataObject);

    }

}
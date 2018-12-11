<?php


namespace Modules\OpenSRS\API\Domain\NameServer\ChildNameServer;


use Modules\OpenSRS\API\OpenSrs;

class CreateChildNameServer extends OpenSrs
{
    public $action = 'create';
    public $object = 'nameserver';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'name',
            'domain',
        ],
    ];

    public $optionalFields = [
        'attributes' => [
            'add_to_all_registry',
            'ipv6',
            'ipaddress',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();

        $this->validateDataObject($dataObject);
        $this->send($dataObject);

    }

}
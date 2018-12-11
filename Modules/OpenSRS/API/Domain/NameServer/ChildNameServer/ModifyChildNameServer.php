<?php


namespace Modules\OpenSRS\API\Domain\NameServer\ChildNameServer;


use Modules\OpenSRS\API\OpenSrs;

class ModifyChildNameServer extends OpenSrs
{
    public $action = 'modify';
    public $object = 'nameserver';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'name',
            'domain'
        ],
    ];

    public $optionalFields = [
        'attributes' => [
            'new_name',
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
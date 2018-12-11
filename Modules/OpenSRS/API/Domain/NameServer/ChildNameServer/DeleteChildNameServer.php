<?php


namespace Modules\OpenSRS\API\Domain\NameServer\ChildNameServer;


use Modules\OpenSRS\API\OpenSrs;

class DeleteChildNameServer extends OpenSrs
{
    public $action = 'delete';
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
            'ipv6',
            'ipaddress'
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();

        $this->validateDataObject($dataObject);
        $this->send($dataObject);

    }

}
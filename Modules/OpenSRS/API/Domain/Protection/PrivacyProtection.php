<?php


namespace Modules\OpenSRS\API\Domain\Protection;


use Modules\OpenSRS\API\OpenSrs;

class PrivacyProtection extends OpenSrs
{
    public $action = 'submit_bulk_change';
    public $object = 'bulk_change attributes';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'change_items',
            'change_type',
            'op_type',
        ],
    ];

    public $optionalFields = [
        'attributes' => [
            'apply_to_locked_domains',
            'contact_email',
        ],
    ];

    public function __construct($dataObject)
    {
        parent::__construct();

        $this->validateDataObject($dataObject);
        $this->send($dataObject);

    }

}
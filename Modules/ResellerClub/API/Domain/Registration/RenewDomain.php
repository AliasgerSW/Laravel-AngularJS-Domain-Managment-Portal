<?php


namespace Modules\ResellerClub\API\Domain\Registration;


use Modules\ResellerClub\API\ResellerClub;

class RenewDomain extends ResellerClub
{
    public $action = 'renew-domain';
    public $url = 'domains/renew';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'years',
            'exp-date',
            'invoice-option',

        ]
    ];
    //also supports attr-name and attr-value
    public $optionalFields = [
        'attributes' => [
            'purchase-privacy',

        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
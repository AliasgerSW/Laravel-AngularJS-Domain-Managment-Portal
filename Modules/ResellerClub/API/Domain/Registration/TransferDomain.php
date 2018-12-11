<?php


namespace Modules\ResellerClub\API\Domain\Registration;


use Modules\ResellerClub\API\ResellerClub;

class TransferDomain extends ResellerClub
{
    public $action = 'transfer-domain';
    public $url = 'domains/transfer';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'customer-id',
            'reg-contact-id',
            'admin-contact-id',
            'tech-contact-id',
            'billing-contact-id',
            'invoice-option',

        ]
    ];
    //possible attr-name and attr-value
    public $optionalFields = [
        'attributes' => [
            'auth-code',
            'purchase-privacy',
            'protect-privacy',
            'ns',
            'attr-name',
            'attr-value',

        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
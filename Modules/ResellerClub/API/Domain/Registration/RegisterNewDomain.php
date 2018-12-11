<?php


namespace Modules\ResellerClub\API\Domain\Registration;


use Modules\ResellerClub\API\ResellerClub;

class RegisterNewDomain extends ResellerClub
{
    public $action = 'register-new-domain';
    public $url = 'domains/register';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'domain-name',
            'years',
            'ns',
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
            'purchase-privacy',
            'protect-privacy',
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
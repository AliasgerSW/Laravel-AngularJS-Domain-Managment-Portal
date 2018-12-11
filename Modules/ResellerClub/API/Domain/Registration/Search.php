<?php


namespace Modules\ResellerClub\API\Domain\Registration;


use Modules\ResellerClub\API\ResellerClub;

class Search extends ResellerClub
{
    public $action = 'search-domain';
    public $url = 'domains/search';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'no-of-records',
            'page-no',

        ]
    ];
    public $optionalFields = [
        'attributes' => [
            'order-by',
            'order-id',
            'reseller-id',
            'customer-id',
            'show-child-orders',
            'product-key',
            'status',
            'domain-name',
            'privacy-enabled',
            'creation-date-start',
            'creation-date-end',
            'expiry-date-start',
            'expiry-date-end',

        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
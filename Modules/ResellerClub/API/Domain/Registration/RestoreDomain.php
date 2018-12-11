<?php


namespace Modules\ResellerClub\API\Domain\Registration;


use Modules\ResellerClub\API\ResellerClub;

class RestoreDomain extends ResellerClub
{
    public $action = 'restore-domain';

    public $url = 'domains/restore';

    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'invoice-option', //Options: NoInvoice or PayInvoice or KeepInvoice
        ],
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
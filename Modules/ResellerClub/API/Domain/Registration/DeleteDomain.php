<?php


namespace Modules\ResellerClub\API\Domain\Registration;


use Modules\ResellerClub\API\ResellerClub;

class DeleteDomain extends ResellerClub
{
    public $action = 'delete-domain';

    public $url = 'domains/delete';

    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
        ],
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
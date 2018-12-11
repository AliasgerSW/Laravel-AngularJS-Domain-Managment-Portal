<?php


namespace Modules\ResellerClub\API\DNS;


use Modules\ResellerClub\API\ResellerClub;

class ActivateDnsService extends ResellerClub
{
    public $action = 'activate-dns-service';
    public $url = 'dns/activate';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
<?php


namespace Modules\ResellerClub\API\Domain\Protection\TheftProtection;


use Modules\ResellerClub\API\ResellerClub;

class DisableTheftProtection extends ResellerClub
{
    public $action = 'disable-theft-protection';
    public $url = 'domains/disable-theft-protection';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id'
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
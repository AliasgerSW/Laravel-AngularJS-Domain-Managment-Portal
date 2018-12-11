<?php


namespace Modules\ResellerClub\API\Domain\Protection;


use Modules\ResellerClub\API\ResellerClub;

class PrivacyProtection extends ResellerClub
{
    public $action = 'privacy-protection';
    public $url = 'domains/modify-privacy-protection';
    public $resultData;

    public $requiredFields = [
        'attributes' => [
            'order-id',
            'protect-privacy',
            'reason',
        ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
<?php


namespace Modules\ResellerClub\API\Price;


use Modules\ResellerClub\API\ResellerClub;

class PrivacyProtectionPrice extends ResellerClub
{
    public $action = 'get-privacy-protection-price';
    public $url = 'products/reseller-cost-price';
    public $resultData;

    public $requiredFields = [ ];

    public $optionalFields = [
      'attributes' => [
          'reseller-id',
      ]
    ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
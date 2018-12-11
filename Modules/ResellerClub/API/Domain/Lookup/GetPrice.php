<?php


namespace Modules\ResellerClub\API\Domain\Lookup;


use Modules\ResellerClub\API\ResellerClub;

class GetPrice extends ResellerClub
{
    public $action = 'getprice';
    public $url = 'products/reseller-cost-price';
    public $resultData;

    public $requiredFields = [ ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
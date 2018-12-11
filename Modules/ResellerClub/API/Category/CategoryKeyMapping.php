<?php


namespace Modules\ResellerClub\API\Category;


use Modules\ResellerClub\API\ResellerClub;

class CategoryKeyMapping extends ResellerClub
{
    public $action = 'categorykeymapping';
    public $url = 'products/category-keys-mapping';
    public $resultData;

    public $requiredFields = [ ];

    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }
}
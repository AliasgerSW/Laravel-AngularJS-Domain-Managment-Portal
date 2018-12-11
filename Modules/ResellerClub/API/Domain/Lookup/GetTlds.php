<?php


namespace Modules\ResellerClub\API\Domain\Lookup;


use Modules\ResellerClub\API\ResellerClub;

class GetTlds extends ResellerClub
{
    public $action = 'gettlds';

    public $url = 'domains/tld-info';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * GetTlds constructor.
     * @param $dataObject
     * @throws \Exception
     */
    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url);
    }

}
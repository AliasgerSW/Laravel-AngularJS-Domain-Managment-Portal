<?php
/**
 * Created by PhpStorm.
 * User: ac
 * Date: 6/22/18
 * Time: 12:45 AM
 */

namespace Modules\ResellerClub\API\Domain\Protection;


use Modules\ResellerClub\API\ResellerClub;

class ModifyDomainSecret extends ResellerClub
{
    public $url = 'domains/modify-auth-code';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * ModifyDomainSecret constructor.
     * @param $dataObject
     * @throws \Exception
     */
    public function __construct($dataObject)
    {
        parent::__construct();
        $this->validateDataObject($dataObject);
        $this->send($dataObject, $this->url, true);
    }

}
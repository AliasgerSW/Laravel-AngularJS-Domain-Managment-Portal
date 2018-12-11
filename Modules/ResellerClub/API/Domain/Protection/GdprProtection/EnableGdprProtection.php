<?php
/**
 * Created by PhpStorm.
 * User: ac
 * Date: 6/21/18
 * Time: 11:01 PM
 */

namespace Modules\ResellerClub\API\Domain\Protection\GdprProtection;

use Modules\ResellerClub\API\ResellerClub;


class EnableGdprProtection extends ResellerClub
{
    public $url = 'domains/gdpr/enable';

    public $resultData;

    public $requiredFields = [
        'attributes' => [],
    ];

    /**
     * EnableGdprProtection constructor.
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
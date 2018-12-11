<?php


namespace Modules\OpenSRS\API\SubReseller;


use Modules\OpenSRS\API\OpenSrs;

class SubResellerGet extends OpenSrs
{
    public $action = 'get';
    public $object = 'subreseller';
    public $requiredFields = [
        'attributes' => [
            'username',
            ]
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
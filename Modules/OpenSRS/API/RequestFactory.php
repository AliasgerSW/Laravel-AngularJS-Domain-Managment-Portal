<?php


namespace Modules\OpenSRS\API;


class RequestFactory
{
    public static $RequestRoutes = [
        'lookupdomain' => 'Modules\OpenSRS\API\Domain\Lookup\LookUpDomain',
        'getprice' => 'Modules\OpenSRS\API\Domain\Lookup\GetPrice',
        'add-child-name-server' => 'Modules\OpenSRS\API\Domain\NameServer\ChildNameServer\CreateChildNameServer',
        'delete-child-name-server' => 'Modules\OpenSRS\API\Domain\NameServer\ChildNameServer\DeleteChildNameServer',
        'modify-child-name-server' => 'Modules\OpenSRS\API\Domain\NameServer\ChildNameServer\ModifyChildNameServer',
        'privacy-protection' => 'Modules\OpenSRS\API\Domain\Protection\PrivacyProtection',
    ];

    public static function build($func, $dataObject)
    {
        $route = '';
        $routeKey = strtolower($func);
        unset($dataObject->func);
        if (array_key_exists($routeKey, self::$RequestRoutes)) {
            $route = self::$RequestRoutes[$routeKey];
        }

        $class =$route;

        if (class_exists($class)) {
            return new $class($dataObject);
        } else {
            throw new \Exception("This function is not supported");
        }
    }

}
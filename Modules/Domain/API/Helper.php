<?php

namespace Modules\Domain\API;

class Helper
{
    /**
     * Format attributes as per registrar
     * @param $attributes
     * @param $registrar
     * @return mixed
     */
    public function formatAttributeForLookUp($attributes, $registrar)
    {
        if ($registrar == 'OpenSRS') {
            $attributes['domain'] = $attributes['domain'].'.'.$attributes['tlds'][0];
            return $attributes;
        }
        //for ResellerClub
        $attributes['domain-name'] = $attributes['domain'];
        unset($attributes['domain']);
        return $attributes;
    }

    public function  getTldKeyName($tldName, $domorder = [])
    {
        if ($domorder) {
            foreach($domorder as $tld) {
                if ($tld) {
                    foreach($tld as $key => $singleTld) {

                        if (in_array($tldName, $singleTld)) {
                            return $key;
                        }
                    }
                }
            }
        }

        return false;
    }

    public function formateDomainPrice($categories, $prices)
    {
        $formatedResult = [];
        foreach((array)$categories as $category) {
            if($category) {
                foreach ($category as $key => $singleTld) {
                    foreach ($singleTld as $tld) {
                        $formatedResult[$tld] = $prices[$key];
                    }
                }

            }
        }
        $formatedResult['privacy_protection'] = $prices['privacy_protection'];
        return $formatedResult;

    }

}
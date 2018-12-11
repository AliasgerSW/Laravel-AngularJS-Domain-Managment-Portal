<?php


namespace Modules\ResellerClub\API;


class ProcessRequest
{
    public function processData($data)
    {
        $json = str_replace('\\"', '"', $data);
        $dataArray = json_decode($json, true);
        //convert associative array to object
        $dataObject = $this->arrayToObject($dataArray);
        $classCall = null;
        $classCall = RequestFactory::build($dataObject->func, $dataObject);
        return $classCall;
    }

    public function arrayToObject($dataArray)
    {
        if (is_array($dataArray)) {
            $data = json_decode(json_encode($dataArray));
            return $data;
        } else {
            throw new \Exception("Wrong Data Provided");
        }

    }
}
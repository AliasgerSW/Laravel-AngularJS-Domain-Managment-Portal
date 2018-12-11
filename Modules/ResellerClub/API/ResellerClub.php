<?php


namespace Modules\ResellerClub\API;


class ResellerClub
{
    private $apiKey;
    private $resellerId;

    const TEST_API_URI = "https://test.httpapi.com/api/";

    const lIVE_API_URI = "https://httpapi.com/api";

    public function __construct()
    {
        $this->apiKey = env('RESELLERCLUB_API_KEY', '9TbXCKPyRUSEEgwbD84NUeBeIm7QWk9M');
        $this->resellerId = env('RESELLERCLUB_ID', '738974');
    }

    public function send($dataObject, $url, $post_request = false)
    {
        if (env('RESELLERCLUB_MODE', 'test') == 'live') {
            $url = self::lIVE_API_URI.$url.'.json?';
        } else {
            $url = self::TEST_API_URI.$url.'.json?';
        }
        $url =  $this->processUrl($dataObject, $url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($post_request){
            curl_setopt($curl, CURLOPT_POST, 1);
        }
        $response = curl_exec($curl);
        $apiDataInArray = json_decode($response, True);
        if(!isset($apiDataInArray['status'])) {
            return $this->resultData = $apiDataInArray;
        }
        if ($apiDataInArray['status'] == null) {
            $this->resultData =['status' => 'ERROR', 'message' => 'Error from the API'];
        } else {
            $this->resultData = $apiDataInArray;
        }
    }

    public function validateDataObject($dataObject, $requiredFields = null)
    {
        if (is_null($requiredFields)) {
            if (isset($this->requiredFields) && !empty($this->requiredFields)) {
                $requiredFields = $this->requiredFields;
            } else {
                $requiredFields = [];
            }
        }
        if (is_array($requiredFields)) {
            foreach ($requiredFields as $key => $field) {
                if (is_array($field)) {
                    if (!isset($dataObject->$key)) {
                        throw new \Exception("$field: Field is not defined");
                    }
                    $this->validateDataObject($dataObject->$key, $field);
                } else {
                    if (!isset($dataObject->$field) || !$this->isValidField($dataObject->$field)) {
                        throw new \Exception("Fields is not defined");
                    }
                }
            }
        }
    }

    public function isValidField($field)
    {
        $isArray = is_array($field);

        switch (true) {
            case $isArray && count($field):
            case !$isArray && strlen($field):
                $isValid = true;
                break;
            default:
                $isValid = false;

        }

        return $isValid;
    }

    public function processUrl($dataObject, $url)
    {
        //to concate api key and id
        $url .='auth-userid='.$this->resellerId.'&api-key='.$this->apiKey;
        //converting into the array
        $dataArray = json_decode(json_encode($dataObject), True);
        if (array_key_exists("attributes", $dataArray)) {
            foreach ($dataArray['attributes'] as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $v) {
                        $url .= '&'.$key.'='.$v;
                    }
                } else {
                    $url .= '&'.$key.'='.$value;
                }
            }
        }
        return $url;

    }

}
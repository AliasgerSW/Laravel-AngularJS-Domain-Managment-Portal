<?php


namespace Modules\OpenSRS\API;


class OpenSrs
{
    protected $protocol = 'XCP';
    protected $opsEnvelopeService;
    protected $processRequest;

    public $requiredFields = [];

    public function __construct()
    {
        //dependency injection for the OpsEnvelope class
        $this->opsEnvelopeService = new OpsEnvelope();
        $this->processRequest = new ProcessRequest();
    }

    public function send($dataObject)
    {
        if (!is_object($dataObject)) {
            $dataObject = new \stdClass();
        }
        $dataObject->protocol = $this->protocol;
        $dataObject->action = $this->action;
        $dataObject->object = $this->object;

        if (isset($dataObject->attributes->domain) && substr_count($dataObject->attributes->domain, '.') > 1) {
            $dataObject->attributes->domain = str_replace('www.', '', $dataObject->attributes->domain);
        }

        //format array to XML
        $requestInXml = $this->opsEnvelopeService->encodeToXml(json_decode(json_encode($dataObject), true));
        //send Request to API
        $responseInXml = $this->sendRequest($requestInXml);

        $arrayResponse = $this->opsEnvelopeService->decodeInArray($responseInXml);

        if (isset($arrayResponse['is_success']) && isset($arrayResponse['response_text'])) {
            if ($arrayResponse['is_success'] == 1) {
                $arrayResponse['status'] = "SUCCESS";
                $arrayResponse['message'] = $arrayResponse['response_text'];
            } else {
                $arrayResponse['status'] = "ERROR";
                $arrayResponse['message'] = $arrayResponse['response_text'];
            }
        } else {
            $arrayResponse['status'] = "ERROR";
            $arrayResponse['message'] = "ERROR Occur from OpenSRS API";
        }
        //for the result
        $this->resultData = $arrayResponse;

    }


    public function sendRequest($request)
    {
        $data = [
            'Content-Type:text/xml',
            'X-Username:' . env('OPENSRS_USERNAME'),
            'X-Signature:' . md5(md5($request . env('OPENSRS_API_KEY')) . env('OPENSRS_API_KEY')),
        ];
        $ch = curl_init(env('OPENSRS_API_HOST_PORT'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

        $response = curl_exec($ch);
        return $response;
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


}
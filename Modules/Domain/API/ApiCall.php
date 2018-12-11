<?php

namespace Modules\Domain\API;

use Modules\OpenSRS\API\ProcessRequest;

class ApiCall
{

    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper();
    }

    /**
     * To check availability of the domain
     * @param $registrar
     * @param array $attributes
     * @return mixed|null
     * @throws \Exception
     */
    public function domainLookUp($registrar, $attributes = [])
    {
        if ($registrar == 'OpenSRS') {
            $processRequest = new ProcessRequest();
        } elseif ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'lookupdomain';
        $attributes = $this->helper->formatAttributeForLookUp($attributes, $registrar);
        $callString['attributes'] = $attributes;
        dd($callString);
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler;
    }

    /**
     * To get cost price of tlds
     * @param $registrar
     * @param array $attributes eg:['tld'=>'com'] for single and no parameter to fetch all tlds price
     * @return null
     * @throws \Exception
     */
    public function getCostPriceOfTld($registrar, $attributes = [])
    {
        //create call String for the request
        $callString = [];
        $callString['func'] = 'getprice';
        if ($registrar == 'OpenSRS') {
            if (!$attributes) {
                throw new \Exception("Please provide TLD");
            }
            $attributes['domain'] = 'example.'.$attributes['tld'];
            $processRequest = new ProcessRequest();
            $callString['attributes'] = $attributes;
        } elseif ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            throw new \Exception("Wrong Registrar Given");
        }

        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if ($registrar == 'ResellerClub') {
            //get the key for the tld first
            $lookUpArray = [
                'func' => 'categorykeymapping',

            ];
            $callString = json_encode($lookUpArray);
            $processRequestForKey = new \Modules\ResellerClub\API\ProcessRequest();
            $categoryObject = $processRequestForKey->processData($callString);

            if (!isset($attributes['tld'])) {
                return $this->helper->formateDomainPrice($categoryObject->resultData['domorder'], $handler->resultData);
            }


            $tldName = $this->helper->getTldKeyName($attributes['tld'], $categoryObject->resultData['domorder']);
            if ($tldName) {
                return $handler->resultData[$tldName];
            }
            return null;
        }
        //for opensrs
        return $handler->resultData['attributes']['price'];
    }

    /**
     * Get TLDs from ResellerClub
     * @param $registrar
     * @param array $attributes
     * @return mixed|null
     * @throws \Exception
     */
    public function getTlds($registrar, $attributes = [])
    {
        if ($registrar == 'OpenSRS') {
            throw new \Exception("OpenSRS is currently not supported!");
        } elseif ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            throw new \Exception("Wrong Registrar Given");
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'gettlds';
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler;
    }


    /**
     * Enable GDPR Protection
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     * @throws \Exception  when invalid registrar
     */
    public function enableGdprProtection($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'enable-gdpr-protection';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    /**
     * Disable GDPR Protection
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     * @throws \Exception  when invalid registrar
     */
    public function disableGdprProtection($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'disable-gdpr-protection';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    /**
     * Modify Domain Secret from ResellerClub
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     * @throws \Exception  when invalid registrar
     */
    public function modifyDomainSecret($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'modify-domain-secret';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['auth-code'])) {
            return ['status' => 'ERROR', 'message' => 'Auth code is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    /**
     * Get Contact
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function getContact($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'get-contact';
        if (!isset($attributes['contact-id'])) {
            return ['status' => 'ERROR', 'message' => 'Contact ID is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData;
    }

    /**
     * Add Contact
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function addContact($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'add-contact';
        if (!isset($attributes['customer-id'])) {
            return ['status' => 'ERROR', 'message' => 'Customer Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData;
    }

    /**
     * Delete Contact
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function deleteContact($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'delete-contact';
        if (!isset($attributes['contact-id'])) {
            return ['status' => 'ERROR', 'message' => 'Contact Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    /**
     * To activate/deactive theft protection
     * @param $registrar OpenSRS or ResellerClub
     * @param $orderId Order Id saved on tlds table
     * @param bool $enable
     * @return array status = Success -> Success Transaction, Error -> no order id, Failed -> deactivating domain which is already deactive
     * @throws \Exception
     */
    public function changeTheftProtectionStatus($registrar, $attributes = [], $enable = false)
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        if ($enable === true || $enable == 'true') {
            $callString['func'] = 'enable-theft-protection';
        } elseif ($enable === false || $enable == 'false') {
            $callString['func'] = 'disable-theft-protection';
        }
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    /**
     * Change status of the privacy protection
     * @param $registrar
     * @param array $attributes
     * @return array
     */
    public function changePrivacyProtectionStatus($registrar, $attributes = [])
    {
        if (!isset($attributes['order-id']) || !isset($attributes['protect-privacy']) || !isset($attributes['reason'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id, Protect Privacy status and Reason are mandatory fields'];
        }
        $callString = [];
        $callString['func'] = 'privacy-protection';
        if ($registrar == 'OpenSRS') {
            $processRequest = new ProcessRequest();
            $attributes['change_items'] = $attributes['order-id'];
            $attributes['change_type'] = "whois_privacy";
            $attributes['op_type'] = ($attributes['protect-privacy'] === true || $attributes['protect-privacy']=='true') ? 'enable' : 'disable';
            unset($attributes['reason']);
            unset($attributes['protect-privacy']);
        } elseif ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
            $attributes['protect-privacy'] = ($attributes['protect-privacy'] === true || $attributes['protect-privacy']=='true') ? 'true' : 'false';
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }

        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    public function modifyNameServer($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }

        $callString = [];
        $callString['func'] = 'modify-name-server';
        if (!isset($attributes['ns'])) {
            return ['status' => 'ERROR', 'message' => 'Please Provide Name Server'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    /**
     * Activate domain forwarding
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function activateDomainForwarding($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'activate-domain-forwarding';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['forward-to'])) {
            return ['status' => 'ERROR', 'message' => 'Forward To URL is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "success") { // 's' in success is small case here
            return ['status' => "SUCCESS", 'message' => '']; // Because there is only status key returned by the ResellerClub API
        }
        return $handler->resultData;
    }

    /**
     * Modify domain forwarding
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function modifyDomainForwarding($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'activate-domain-forwarding';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['forward-to'])) {
            return ['status' => 'ERROR', 'message' => 'Forward To URL is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = strtolower($handler->resultData['status']);
        if ($status == "success") { // 's' in success is small case here
            return ['status' => "SUCCESS", 'message' => '']; // Because there is only status key returned by the ResellerClub API
        }
        return $handler->resultData;
    }

    /**
     * Activate Free Email Service
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function activateFreeEmail($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'activate-free-email';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if (isset($handler->resultData['success'])) { // 's' in success is small case here
            return ['status' => "SUCCESS", 'message' => $handler->resultData['success']];
        }
        return $handler->resultData;
    }

    /**
     * Add email user account as in Free Email management
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function addEmailUserAccount($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'add-email-user-account';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['email'])) {
            return ['status' => 'ERROR', 'message' => 'Email is required'];
        }
        if (!isset($attributes['passwd'])) {
            return ['status' => 'ERROR', 'message' => 'Passwd is required'];
        }
        if (!isset($attributes['notification-email'])) {
            return ['status' => 'ERROR', 'message' => 'Notification Email is required'];
        }
        if (!isset($attributes['first-name'])) {
            return ['status' => 'ERROR', 'message' => 'First Name is required'];
        }
        if (!isset($attributes['last-name'])) {
            return ['status' => 'ERROR', 'message' => 'Last Name is required'];
        }
        if (!isset($attributes['country-code'])) {
            return ['status' => 'ERROR', 'message' => 'Country Code is required'];
        }
        if (!isset($attributes['language-code'])) {
            return ['status' => 'ERROR', 'message' => 'Language Code is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if ($handler->resultData['response']['status'] == 'SUCCESS') {
            return ['status' => "SUCCESS", 'message' => '', 'data' => $handler->resultData['response']['user']];
        }
        else if($handler->resultData['response']['status'] == 'FAILURE'){
            return ['status' => "ERROR", 'message' => $handler->resultData['response']['message']];
        }
        return $handler->resultData;
    }

    /**
     * Add email user forward only account
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function addForwardOnlyAccount($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'add-email-user-forward-only-account';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['email'])) {
            return ['status' => 'ERROR', 'message' => 'Email is required'];
        }
        if (!isset($attributes['forwards'])) {
            return ['status' => 'ERROR', 'message' => 'Forwards is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'SUCCESS') {
            return ['status' => "SUCCESS", 'message' => ''];
        }
        else if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'FAILURE') {
            return ['status' => "ERROR", 'message' => $handler->resultData['response']['message']];
        }
        return $handler->resultData;
    }

    /**
     * Get email user details
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function getEmailUser($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'get-email-user';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['email'])) {
            return ['status' => 'ERROR', 'message' => 'Email is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'SUCCESS') {
            return ['status' => "SUCCESS", 'message' => '', 'data' => $handler->resultData['response']['user']];
        }
        else if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'FAILURE') {
            return ['status' => "ERROR", 'message' => $handler->resultData['response']['message']];
        }
        return $handler->resultData;
    }

    /**
     * Modify email user
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function modifyEmailUser($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'get-email-user';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['email'])) {
            return ['status' => 'ERROR', 'message' => 'Email is required'];
        }
        if (!isset($attributes['notification-email'])) {
            return ['status' => 'ERROR', 'message' => 'Notification Email is required'];
        }
        if (!isset($attributes['first-name'])) {
            return ['status' => 'ERROR', 'message' => 'First Name is required'];
        }
        if (!isset($attributes['last-name'])) {
            return ['status' => 'ERROR', 'message' => 'Last Name is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'SUCCESS') {
            return ['status' => "SUCCESS", 'message' => ''];
        }
        else if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'FAILURE') {
            return ['status' => "ERROR", 'message' => $handler->resultData['response']['message']];
        }
        return $handler->resultData;
    }

    /**
     * Suspend email user
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function suspendEmailUser($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'suspend-email-user';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['email'])) {
            return ['status' => 'ERROR', 'message' => 'Email is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'SUCCESS') {
            return ['status' => "SUCCESS", 'message' => ''];
        }
        else if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'FAILURE') {
            return ['status' => "ERROR", 'message' => $handler->resultData['response']['message']];
        }
        return $handler->resultData;
    }

    /**
     * Delete email user
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function deleteEmailUser($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'delete-email-user';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['email'])) {
            return ['status' => 'ERROR', 'message' => 'Email is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'SUCCESS') {
            return ['status' => "SUCCESS", 'message' => ''];
        }
        else if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'FAILURE') {
            return ['status' => "ERROR", 'message' => $handler->resultData['response']['message']];
        }
        return $handler->resultData;
    }

    /**
     * Change email user password
     * @param $registrar OpenSRS or ResellerClub
     * @param $attributes
     * @return array
     */
    public function changeEmailUserPassword($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        $callString = [];
        $callString['func'] = 'delete-email-user';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id is required'];
        }
        if (!isset($attributes['email'])) {
            return ['status' => 'ERROR', 'message' => 'Email is required'];
        }
        if (!isset($attributes['old-passwd'])) {
            return ['status' => 'ERROR', 'message' => 'Old Passwd is required'];
        }
        if (!isset($attributes['new-passwd'])) {
            return ['status' => 'ERROR', 'message' => 'New Passwd is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'SUCCESS') {
            return ['status' => "SUCCESS", 'message' => ''];
        }
        else if (isset($handler->resultData['response']['status']) && $handler->resultData['response']['status'] == 'FAILURE') {
            return ['status' => "ERROR", 'message' => $handler->resultData['response']['message']];
        }
        return $handler->resultData;
    }

    /**
     * to add child name server, works only for single nameserver but can provide multiple ip
     * Validation: ns record must be same as domain name
     * @param $registrar
     * @param array $attributes
     * @return array
     */
    public function addChildNameServer($registrar, $attributes = [])
    {
        $callString = [];
        $callString['func'] = 'add-child-name-server';
        if (!isset($attributes['order-id']) || !isset($attributes['cns']) || !isset($attributes['ip'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id(order-id), Child nameserver(cns) and IP(ip) are mandatory '];
        }
        if ($registrar == 'OpenSRS') {
            $processRequest = new ProcessRequest();
            $attributes['domain'] = $attributes['order-id'];
            unset($attributes['order-id']);
            $attributes['name'] = $attributes['cns'];
            unset($attributes['cns']);
            $attributes['ipaddress'] = $attributes['ip'];
            unset($attributes['ip']);
        } elseif ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();

        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }

        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function deleteChildNameServer($registrar, $attributes = [])
    {
        $callString = [];
        if (!isset($attributes['order-id']) || !isset($attributes['cns']) || !isset($attributes['ip'])) {
            return ['status' => 'ERROR', 'message' => 'Order Id(order-id), Child nameserver(cns) and IP(ip) are mandatory '];
        }
        $callString['func'] = 'delete-child-name-server';
        if ($registrar == 'OpenSRS') {
            $processRequest = new ProcessRequest();
            $attributes['domain'] = $attributes['order-id'];
            unset($attributes['order-id']);
            $attributes['name'] = $attributes['cns'];
            unset($attributes['cns']);
            $attributes['ipaddress'] = $attributes['ip'];
            unset($attributes['ip']);
        } elseif ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }

        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function modifyChildNameServerHost($registrar, $attributes = [])
    {
        $callString = [];
        if (!isset($attributes['order-id']) || !isset($attributes['old-cns']) || !isset($attributes['new-cns'])) {
            return ['status' => 'ERROR' , 'message' => 'Order ID(order-id), Old Child Nameserver(old-cns) and New Child Nameserver(new-cns) are mandatory'];
        }
        if ($registrar == 'OpenSRS') {
            $callString['func'] = 'modify-child-name-server';
            $processRequest = new ProcessRequest();
            $attributes['domain'] = $attributes['order-id'];
            unset($attributes['order-id']);
            $attributes['name'] = $attributes['old-cns'];
            unset($attributes['old-cns']);
            $attributes['new_name'] = $attributes['new-cns'];
            unset($attributes['new-cns']);
        } elseif ($registrar == 'ResellerClub') {
            $callString['func'] = 'modify-child-name-server-host';
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }

        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function modifyChildNameServerIP($registrar, $attributes = [])
    {
        $callString = [];
        if (!isset($attributes['order-id']) || !isset($attributes['cns']) || !isset($attributes['old-ip']) || !isset($attributes['new-ip'])) {
            return ['status' => 'ERROR' , 'message' => 'Order ID(order-id), Child Nameserver(cns), Old IP(old-ip) and New IP(new-ip) are mandatory'];
        }
        if ($registrar == 'OpenSRS') {
            $callString['func'] = 'modify-child-name-server';
            $processRequest = new ProcessRequest();
            $attributes['domain'] = $attributes['order-id'];
            unset($attributes['order-id']);
            $attributes['name'] = $attributes['cns'];
            unset($attributes['cns']);
            $attributes['ipaddress'] = $attributes['new-ip'];
            unset($attributes['new-ip']);
        } elseif ($registrar == 'ResellerClub') {
            $callString['func'] = 'modify-child-name-server-ip';
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }

        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    public function activateDnsService($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'activate-dns-service';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR' , 'message' => 'Order ID(order-id)'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;
    }

    /**
     * Add mx record
     * @param $registrar
     * @param array $attributes
     * @return array
     */
    public function addMxRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-mx-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    /**
     * To delete mx record
     * @ is used for default hostname
     * @param $registrar
     * @param array $attributes
     * @return array
     */
    public function deleteMxRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-mx-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value']) || !isset($attributes['host'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value and host are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function modifyMxRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-mx-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['current-value']) || !isset($attributes['new-value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, current-value and new-value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function addTxtRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-txt-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function deleteTxtRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-txt-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value']) || !isset($attributes['host'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value and host are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function modifyTxtRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-txt-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['current-value']) || !isset($attributes['new-value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, current-value and new-value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;
    }

    public function modifySoaRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-soa-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['responsible-person']) || !isset($attributes['refresh']) || !isset($attributes['retry']) || !isset($attributes['expire']) || !isset($attributes['ttl'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, responsible-person, refresh, retry, expire and ttl are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            reset($handler->resultData['msg']);
            return ['status' => "ERROR", 'message' => current($handler->resultData['msg'])];
        }
        return $handler->resultData;
    }

    public function addCnameRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-cname-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function deleteCnameRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-cname-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value']) || !isset($attributes['host'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value and host are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function modifyCnameRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-cname-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['current-value']) || !isset($attributes['new-value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, current-value and new-value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function addIpV4Record($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-ipv4-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;
    }

    public function deleteIpV4Record($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-ipv4-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function modifyIpV4Record($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-ipv4-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['current-value']) || !isset($attributes['new-value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, current-value and new-value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function addIpV6Record($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-ipv6-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function deleteIpV6Record($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-ipv6-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value']) || !isset($attributes['host'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value and host are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function modifyIpV6Record($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-ipv6-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['current-value']) || !isset($attributes['new-value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, current-value and new-value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function addSrvRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-srv-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value']) || !isset($attributes['host'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value and host are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function deleteSrvRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-srv-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value']) || !isset($attributes['host']) || !isset($attributes['port']) || !isset($attributes['weight'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value, host, port and weight  are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function modifySrvRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-srv-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['current-value']) || !isset($attributes['new-value']) || !isset($attributes['host'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, current-value, new-value and host are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;
    }

    /**
     * Search DNS record
     * @param $registrar
     * @param array $attributes
     * @return array
     */
    public function searchDnsRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'search-dns-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['type']) || !isset($attributes['no-of-records']) || !isset($attributes['page-no'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, type, no-of-records and page-no are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if ($handler->resultData['recsindb'] == '0') {
            return ['status' => 'SUCCESS', 'message' => 'Sorry Empty Record'];
        }
        return $handler->resultData;
    }

    /**
     * Get Privacy Protection Price of Tld
     * @param $registrar
     * @param array $attributes
     * @return array
     */
    public function getPrivacyProtectionPrice($registrar, $attributes = [])
    {
        $callString = [];
        $callString['func'] = 'get-privacy-protection-price';
       if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
           return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }

        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData['privacy_protection'];

    }

    /**
     * Add DNSSEC Record
     * @param $registrar
     * @param array $attributes Attributes must contain ['order-id', 'keytag', 'algorithm', 'digesttype', 'digest'] array keys and value
     * @return array
     */
    public function addDnsSecRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-dnssec-record';
        if (!isset($attributes['order-id']) || !isset($attributes['keytag']) || !isset($attributes['algorithm']) || !isset($attributes['digesttype']) || !isset($attributes['digest'])) {
            return ['status' => 'ERROR' , 'message' => 'order-id, keytag, algorithm, digesttype and digest are mandatory'];
        }
        $attr = ['order-id' => $attributes['order-id']];
        $counter = 1;
        $attrName = ['keytag', 'algorithm', 'digesttype', 'digest'];
        foreach ($attributes as $key => $value) {
            if (in_array($key, $attrName)) {
                $attr['attr-name' . $counter] = $key;
                $attr['attr-value' . $counter] = $value;
                $counter++;
            }
        }
        $callString['attributes'] = $attr;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    /**
     * Remove DNSSEC
     * @param $registrar
     * @param array $attributes
     * @return array
     */
    public function deleteDnsSecRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-dnssec-record';
        if (!isset($attributes['order-id']) || !isset($attributes['keytag']) || !isset($attributes['algorithm']) || !isset($attributes['digesttype']) || !isset($attributes['digest'])) {
            return ['status' => 'ERROR' , 'message' => 'order-id, keytag, algorithm, digesttype and digest are mandatory'];
        }
        $attr = ['order-id' => $attributes['order-id']];
        $counter = 1;
        $attrName = ['keytag', 'algorithm', 'digesttype', 'digest'];
        foreach ($attributes as $key => $value) {
            if (in_array($key, $attrName)) {
                $attr['attr-name' . $counter] = $key;
                $attr['attr-value' . $counter] = $value;
                $counter++;
            }
        }
        $callString['attributes'] = $attr;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function registerDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'register-new-domain';
        if (!isset($attributes['domain-name']) || !isset($attributes['years']) || !isset($attributes['ns']) || !isset($attributes['customer-id']) || !isset($attributes['reg-contact-id']) || !isset($attributes['admin-contact-id']) || !isset($attributes['tech-contact-id']) || !isset($attributes['billing-contact-id']) || !isset($attributes['invoice-option'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, years, ns, customer-id, reg-contact-id, admin-contact-id, tech-contact-id, billing-contact-id and invoice-option are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['actionstatusdesc']];
        } elseif ($status == "error") {
            return ['status' => "ERROR", 'message' => $handler->resultData['error']];
        }
        return $handler->resultData;

    }

    public function renewDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'renew-domain';
        if (!isset($attributes['order-id']) || !isset($attributes['years']) || !isset($attributes['exp-date']) || !isset($attributes['invoice-option'])) {
            return ['status' => 'ERROR' , 'message' => 'order-id, years, exp-date, invoice-option are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function transferDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'transfer-domain';
        if (!isset($attributes['domain-name']) || !isset($attributes['customer-id']) || !isset($attributes['reg-contact-id']) || !isset($attributes['admin-contact-id']) || !isset($attributes['tech-contact-id']) || !isset($attributes['billing-contact-id']) || !isset($attributes['invoice-option'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, customer-id, reg-contact-id, admin-contact-id, tech-contact-id, billing-contact-id, invoice-option'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function deleteDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-domain';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR' , 'message' => 'order-id is mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        }
        return $handler->resultData;

    }

    public function restoreDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'restore-domain';
        if (!isset($attributes['order-id']) || !isset($attributes['invoice-option'])) {
            return ['status' => 'ERROR' , 'message' => 'order-id and invoice-option are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        }
        return $handler->resultData;

    }

    public function addNsRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'add-ns-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function deleteNsRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'delete-ns-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['value']) || !isset($attributes['host'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, value and host are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => "Successfully Deleted"];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function modifyNsRecord($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar Given'];
        }
        $callString = [];
        $callString['func'] = 'modify-ns-record';
        if (!isset($attributes['domain-name']) || !isset($attributes['current-value']) || !isset($attributes['new-value'])) {
            return ['status' => 'ERROR' , 'message' => 'domain-name, current-value and new-value are mandatory'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['msg']];
        } elseif ($status == "Failed") {
            return ['status' => "ERROR", 'message' => $handler->resultData['msg']];
        }
        return $handler->resultData;

    }

    public function lockDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        $callString = [];
        $callString['func'] = 'lock-order';
        if (!isset($attributes['order-id']) || !isset($attributes['reason'])) {
            return ['status' => 'ERROR', 'message' => 'order-id and reason are required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;
    }

    public function suspendDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        $callString = [];
        $callString['func'] = 'suspend-order';
        if (!isset($attributes['order-id']) || !isset($attributes['reason'])) {
            return ['status' => 'ERROR', 'message' => 'order-id and reason are required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function unLockDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        $callString = [];
        $callString['func'] = 'unlock-order';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'order-id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function unSuspendDomain($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        $callString = [];
        $callString['func'] = 'unsuspend-order';
        if (!isset($attributes['order-id'])) {
            return ['status' => 'ERROR', 'message' => 'order-id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        $status = $handler->resultData['status'];
        if ($status == "Success") {
            return ['status' => "SUCCESS", 'message' => $handler->resultData['actionstatusdesc']];
        }
        return $handler->resultData;

    }

    public function searchDomain($registrar, $attributes)
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        $callString = [];
        $callString['func'] = 'search-domain';
        if (!isset($attributes['no-of-records']) || !isset($attributes['page-no'])) {
            return ['status' => 'ERROR', 'message' => 'no-of-records and page-no are required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData;
    }

    /**
     * Add Customer
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function addCustomer($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }

        //create call String for the request
        $callString = [];
        $callString['func'] = 'add-customer';
        if (!isset($attributes['username'])) {
            return ['status' => 'ERROR', 'message' => 'Username is required'];
        }
        if (!isset($attributes['passwd'])) {
            return ['status' => 'ERROR', 'message' => 'Passwd is required'];
        }
        if (!isset($attributes['name'])) {
            return ['status' => 'ERROR', 'message' => 'Name is required'];
        }
        if (!isset($attributes['company'])) {
            return ['status' => 'ERROR', 'message' => 'Company is required'];
        }
        if (!isset($attributes['address-line-1'])) {
            return ['status' => 'ERROR', 'message' => 'Address Line 1 is required'];
        }
        if (!isset($attributes['city'])) {
            return ['status' => 'ERROR', 'message' => 'City is required'];
        }
        if (!isset($attributes['state'])) {
            return ['status' => 'ERROR', 'message' => 'State is required'];
        }
        if (!isset($attributes['country'])) {
            return ['status' => 'ERROR', 'message' => 'Country is required'];
        }
        if (!isset($attributes['zipcode'])) {
            return ['status' => 'ERROR', 'message' => 'Zipcode is required'];
        }
        if (!isset($attributes['phone-cc'])) {
            return ['status' => 'ERROR', 'message' => 'Phone CC is required'];
        }
        if (!isset($attributes['phone'])) {
            return ['status' => 'ERROR', 'message' => 'Phone is required'];
        }
        if (!isset($attributes['lang-pref'])) {
            return ['status' => 'ERROR', 'message' => 'Lang Pref is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData;

    }

    /**
     * Modify Customer
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function ModifyCustomer($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'modify-customer';
        if (!isset($attributes['customer-id'])) {
            return ['status' => 'ERROR', 'message' => 'Customer ID is required'];
        }
        if (!isset($attributes['username'])) {
            return ['status' => 'ERROR', 'message' => 'Username is required'];
        }
        if (!isset($attributes['name'])) {
            return ['status' => 'ERROR', 'message' => 'Name is required'];
        }
        if (!isset($attributes['company'])) {
            return ['status' => 'ERROR', 'message' => 'Company is required'];
        }
        if (!isset($attributes['address-line-1'])) {
            return ['status' => 'ERROR', 'message' => 'Address Line 1 is required'];
        }
        if (!isset($attributes['city'])) {
            return ['status' => 'ERROR', 'message' => 'City is required'];
        }
        if (!isset($attributes['state'])) {
            return ['status' => 'ERROR', 'message' => 'State is required'];
        }
        if (!isset($attributes['country'])) {
            return ['status' => 'ERROR', 'message' => 'Country is required'];
        }
        if (!isset($attributes['zipcode'])) {
            return ['status' => 'ERROR', 'message' => 'Zipcode is required'];
        }
        if (!isset($attributes['phone-cc'])) {
            return ['status' => 'ERROR', 'message' => 'Phone CC is required'];
        }
        if (!isset($attributes['phone'])) {
            return ['status' => 'ERROR', 'message' => 'Phone is required'];
        }
        if (!isset($attributes['lang-pref'])) {
            return ['status' => 'ERROR', 'message' => 'Lang Pref is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData;
    }

    /**
     * Delete Customer
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function deleteCustomer($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'delete-customer';
        if (!isset($attributes['customer-id'])) {
            return ['status' => 'ERROR', 'message' => 'Customer Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData;
    }

    /**
     * Get Customer
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function getCustomerByUsername($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'get-customer-by-username';
        if (!isset($attributes['username'])) {
            return ['status' => 'ERROR', 'message' => 'Username is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if(isset($handler->resultData['username'])){
            return ['status' => 'SUCCESS', 'message' => '', 'data' => $handler->resultData];
        }
        return $handler->resultData;
    }

    /**
     * Get Customer
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function getCustomerById($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'get-customer-by-id';
        if (!isset($attributes['customer-id'])) {
            return ['status' => 'ERROR', 'message' => 'Customer Id is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        if(isset($handler->resultData['username'])){
            return ['status' => 'SUCCESS', 'message' => '', 'data' => $handler->resultData];
        }
        return $handler->resultData;
    }

    /**
     * Change Customer's Password
     * @param $registrar OpenSRS or ResellerClub
     * @param array $attributes
     * @return mixed|null
     */
    public function changeCustomerPassword($registrar, $attributes = [])
    {
        if ($registrar == 'ResellerClub') {
            $processRequest = new \Modules\ResellerClub\API\ProcessRequest();
        } else {
            return ['status' => 'ERROR', 'message' => 'Wrong Registrar'];
        }
        //create call String for the request
        $callString = [];
        $callString['func'] = 'change-customer-password';
        if (!isset($attributes['customer-id'])) {
            return ['status' => 'ERROR', 'message' => 'Customer Id is required'];
        }
        if (!isset($attributes['new-passwd'])) {
            return ['status' => 'ERROR', 'message' => 'New Passwd is required'];
        }
        $callString['attributes'] = $attributes;
        $request = json_encode($callString);
        $handler = $processRequest->processData($request);
        return $handler->resultData;
    }

}
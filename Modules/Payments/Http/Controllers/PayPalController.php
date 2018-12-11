<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


class PayPalController extends Controller
{






    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('payments::paypal.index');
    }

    public function proRedirect()
    {
        return view('payments::paypal.indexpro');
    }



    public function processProPayment(Request $request)
    {


        $user_name = env('PAYPAL_USERNAME', '');
        $password = env('PAYPAL_PASSWORD', '');
        $signature = env('PAYPAL_SIGNATURE', '');
        $api_version = env('PAYPAL_API_VERSION', '');
        $api_endpoint = env('PAYPAL_API_ENDPOINT', '');

        $request_params = array
        (
            'METHOD' => 'DoDirectPayment',
            'USER' => $user_name,
            'PWD' => $password,
            'SIGNATURE' => $signature,
            'VERSION' => $api_version,
            'PAYMENTACTION' => 'Sale',
            'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
            'CREDITCARDTYPE' => 'Visa',
            'ACCT' => $request->card_no,
            'EXPDATE' => $request->exp,
            'CVV2' => $request->cvv,
            'FIRSTNAME' => $request->first_name,
            'LASTNAME' => $request->last_name,
            'STREET' => $request->street,
            'CITY' => $request->city,
            'STATE' => $request->state,
            'COUNTRYCODE' => $request->country_code,
            'ZIP' => $request->zip,
            'AMT' => '100.00',
            'CURRENCYCODE' => 'USD',
            'DESC' => 'Testing Payments Pro'
        );

        $nvp_string = '';
        foreach($request_params as $var=>$val)
        {
            $nvp_string .= '&'.$var.'='.urlencode($val);
        }

// Send NVP string to PayPal and store response
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, $api_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

        $result = curl_exec($curl);
        curl_close($curl);

        dd(self::NVPToArray($result));


    }

    function NVPToArray($NVPString)
    {
        $proArray = array();
        while(strlen($NVPString))
        {
            // name
            $keypos= strpos($NVPString,'=');
            $keyval = substr($NVPString,0,$keypos);
            // value
            $valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
            $valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
            // decoding the respose
            $proArray[$keyval] = urldecode($valval);
            $NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
        }
        return $proArray;
    }



}

<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class SofortController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('payments::index');
    }

    public function processPayment()
    {

        $input_xml = '<?xml version="1.0" encoding="UTF-8"?>
<multipay>
  <amount>11</amount>
  <currency_code>EUR</currency_code>
  <reasons>
    <reason>sofort.com - Test</reason>
    <reason>22192205c0</reason>
  </reasons>
  <sender>
    <holder>Max Mustermann</holder>
    <account_number>23456789</account_number>
    <bank_code>00000</bank_code>
    <iban>DE06000000000023456789</iban>
    <bic>SFRTDE20XXX</bic>
  </sender>
  <email_customer>hamid7499@gmail.com</email_customer>
  <notification_emails>
    <notification_email>hamid7499@gmail.com</notification_email>
  </notification_emails>
  <user_variables>
    <user_variable>Variable 0</user_variable>
  </user_variables>
  <su/>
  <project_id>447775</project_id>
</multipay>
';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sofort.com/api/xml",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $input_xml,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic MTcxNDc4OjYyZmY2ODQ1NDU3MjNhMDA1OGUxNzFmMDhjNzI0N2Rm",
                "Cache-Control: no-cache",
                "Content-Type: text/xml",
                "Postman-Token: d5e1325f-6280-4af6-b384-4d7b658c0375"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $array_data = json_decode(json_encode(@simplexml_load_string($response)), true);

            return Redirect::away($array_data['payment_url']);



        }


    }


}

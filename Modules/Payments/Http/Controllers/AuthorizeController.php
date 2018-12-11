<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AuthorizeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('payments::authorize.index');
    }

    public function processPayment(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $country_code = $request->country_code;
        $state = $request->state;
        $zip = $request->zip;
        $card_num = $request->card_no;
        $card_exp = $request->exp;
        $cvv = $request->cvv;
        $invoice_num = str_random(5);

        $input_xml = '<createTransactionRequest xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd">
  <merchantAuthentication>
    <name>'.env('AUTHORIZE_NET_API_LOGIN_ID','').'</name>
    <transactionKey>'.env('AUTHORIZE_NET_TRANSACTION_KEY','').'</transactionKey>
  </merchantAuthentication>
  <transactionRequest>
    <transactionType>authCaptureTransaction</transactionType>
    <amount>5</amount>
    <payment>
      <creditCard>
        <cardNumber>'.$card_num.'</cardNumber>
        <expirationDate>'.$card_exp.'</expirationDate>
        <cardCode>'.$cvv.'</cardCode>
      </creditCard>
    </payment>
    <order>
     <invoiceNumber>INV-'.$invoice_num.'</invoiceNumber>
     <description>Product Description</description>
    </order>
    <lineItems>
      <lineItem>
        <itemId>1</itemId>
        <name>vase</name>
        <description>Cannes logo </description>
        <quantity>18</quantity>
        <unitPrice>45.00</unitPrice>
      </lineItem>
    </lineItems>
    <tax>
      <amount>4.26</amount>
      <name>level2 tax name</name>
      <description>level2 tax</description>
    </tax>
    <duty>
      <amount>8.55</amount>
      <name>duty name</name>
      <description>duty description</description>
    </duty>
    <shipping>
      <amount>4.26</amount>
      <name>level2 tax name</name>
      <description>level2 tax</description>
    </shipping>
    <poNumber>456654</poNumber>
    <customer>
      <id>99999456654</id>
    </customer>
    <billTo>
      <firstName>'.$first_name.'</firstName>
      <lastName>'.$last_name.'</lastName>
      <company>Souveniropolis</company>
      <address>14 Main Street</address>
      <city>Pecan Springs</city>
      <state>TX</state>
      <zip>44628</zip>
      <country>USA</country>
    </billTo>
    <shipTo>
      <firstName>China</firstName>
      <lastName>Bayles</lastName>
      <company>Thyme for Tea</company>
      <address>12 Main Street</address>
      <city>Pecan Springs</city>
      <state>TX</state>
      <zip>44628</zip>
      <country>USA</country>
    </shipTo>
    <customerIP>192.168.1.1</customerIP>
    <userFields>
      <userField>
        <name>MerchantDefinedFieldName1</name>
        <value>MerchantDefinedFieldValue1</value>
      </userField>
      <userField>
        <name>favorite_color</name>
        <value>blue</value>
      </userField>
    </userFields>
  </transactionRequest>
</createTransactionRequest>';



        $api_endpoint = "https://apitest.authorize.net/xml/v1/request.api";

        //setting the curl parameters.
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, $api_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $input_xml);

        $result = curl_exec($curl);
        curl_close($curl);

//        dd($result);
        //convert the XML result into array
        $array_data = json_decode(json_encode(@simplexml_load_string($result)), true);
dd($array_data['messages']['message']['text'],$array_data);
        print_r('<pre>');
        print_r($array_data);
        print_r('</pre>');
    }
}

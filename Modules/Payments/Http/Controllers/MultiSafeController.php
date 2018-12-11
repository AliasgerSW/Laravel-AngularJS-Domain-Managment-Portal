<?php

namespace Modules\Payments\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
//use HttpRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MultiSafeController extends Controller
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
        $client = new \GuzzleHttp\Client();

        $api_endpoint = env('MULTISAFEPAY_API_END_POINT','');
        $api_key = env('MULTISAFEPAY_API_KEY','');


        try {
            $response = $client->request('POST',
                $api_endpoint . '?api_key=' . $api_key,
                ['body'=>self::_data() ]);
        } catch (GuzzleException $e) {

            dd($e);
        }




        $result =  json_decode($response->getBody(), true);

        return Redirect::away($result['data']['payment_url']);
    }




    public function _data()
    {
        return '{
    "type": "checkout",
    "gateway": null,
    "order_id": 123,
    "currency": "USD",
    "amount": 15,
    "description": "My description",
    "var1": null,
    "var3": null,
    "items": null,
    "manual": null,
    "payment_options": {
        "notification_url": null,
        "cancel_url": null,
        "redirect_url": null,
        "close_window": null
    },
    "plugin": {
        "shop": null,
        "plugin_version": null,
        "shop_version": null,
        "partner": null,
        "shop_root_url": null
    },
    "customer": {
        "locale": null,
        "ip_address": null,
        "forwarded_ip": null,
        "first_name": null,
        "last_name": null,
        "address1": null,
        "address2": null,
        "house_number": null,
        "zip_code": null,
        "city": null,
        "state": null,
        "country": null,
        "phone": null,
        "email": null,
        "referrer": null,
        "user_agent": null
    },
    "delivery": {
        "first_name": null,
        "last_name": null,
        "address1": null,
        "address2": null,
        "house_number": null,
        "zip_code": null,
        "city": null,
        "state": null,
        "country": null,
        "phone": null,
        "email": null
    },
    "gateway_info": {
        "birthday": null,
        "bank_account": null,
        "phone": null,
        "email": null,
        "referrer": null,
        "user_agent": null
    },
    "shopping_cart": {
        "items": [
            {
                "name": null,
                "description": null,
                "unit_price": null,
                "quantity": null,
                "merchant_item_id": null,
                "tax_table_selector": null,
                "weight": {
                    "unit": null,
                    "value": null
                }
            }
        ]
    },
    "checkout_options": {
    "no-shipping-method":true,
        "shipping_methods": {
            "flat_rate_shipping": [
                {
                    "name": "Shaban",
                    "price": null,
                    "allowed_areas": [
                        "NL",
                        "ES"
                    ]
                },
                {
                    "name": "Shaban",
                    "price": null,
                    "excluded_areas": [
                        "NL",
                        "FR",
                        "ES"
                    ]
                }
            ]
        },
        "tax_tables": {
            "default": {
                "shipping_taxed": null,
                "rate": null
            },
            "alternate": [
                {
                    "name": null,
                    "rules": [
                        {
                            "rate": null,
                            "country": null
                        }
                    ]
                }
            ]
        },
        "custom_fields": [
            {
                "name": null,
                "type": null,
                "label": null,
                "description_right": {
                    "value": [
                        {
                            "nl": null
                        },
                        {
                            "en": null
                        }
                    ]
                },
                "validation": {
                    "type": "regex",
                    "data": "^[1]$",
                    "error": [
                        {
                            "nl": null
                        },
                        {
                            "en": null
                        }
                    ]
                }
            },
            {
                "standard_type": "companyname"
            },
            {
                "standard_type": "passportnumber",
                "validation": {
                    "type": null,
                    "data": null,
                    "error": null
                }
            }
        ]
    },
    "google_analytics": {
        "account": "UA-XXXXXXXXX"
    }
}
	';
    }


}



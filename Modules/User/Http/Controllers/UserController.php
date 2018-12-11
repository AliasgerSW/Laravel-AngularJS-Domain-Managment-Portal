<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Contact;
use Modules\User\Entities\CustomerContact;
use Modules\User\Entities\SecurityAnswer;
use Modules\User\Entities\SecurityQuestion;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $contacts = Contact::all();
        return view('user::index',compact('contacts'));
    }


    public function showIndividualForm()
    {

        $questions = SecurityQuestion::all();
        $countries = \Modules\GEO\Entities\Country::all();
        $states = \Modules\GEO\Entities\State::all();
        $cities = \Modules\GEO\Entities\City::all();
        return view('user::individual',compact('questions','countries','states', 'cities'));
    }

    public function showCompanyForm()
    {
        return view('user::company');
    }

    public function savebasic(Request $request)
    {
        $customerContact = new CustomerContact();

        $customerContact->type     = $request->type;
        $customerContact->email    = $request->email;
        $customerContact->password = bcrypt($request->password);

        if ($customerContact->save()) {
            $contact = new Contact();
            $contact->customer_id = $customerContact->id;
            $contact->domain_id = 1;
            $contact->type = "default";
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->middle_name = $request->middle_name;
            $contact->phone = $request->phone;
            $contact->alternative_tel_num = $request->alternative_tel_num;
            $contact->mobile = $request->mobile;
            $contact->email = $request->email;
            $contact->alternative_email = $request->alternative_email;
            $contact->country = $request->country;
            $contact->org_name = "";
            $contact->state = $request->state;
            $contact->city = $request->city;
            $contact->address1 = $request->address;
            $contact->postal_code = $request->postal_code;
            $contact->fax = $request->fax;
            $contact->notes = $request->notes;

            if (!$request->has('billing')){

                $billing_contact = new Contact();
                $billing_contact->customer_id = $customerContact->id;
                $billing_contact->domain_id = 1;
                $billing_contact->type = "billing";
                $billing_contact->first_name = $request->billing_first_name;
                $billing_contact->last_name = $request->billing_last_name;
                $billing_contact->middle_name = $request->billing_middle_name;
                $billing_contact->phone = $request->billing_phone;
                $billing_contact->email = $request->billing_email;
                $billing_contact->country = $request->billing_country;
                $billing_contact->state = $request->billing_state;
                $billing_contact->postal_code = $request->billing_postal_code;
                $billing_contact->city = $request->billing_city;
                $billing_contact->address1 = $request->billing_address;
                $billing_contact->fax = $request->billing_fax;
                $billing_contact->notes = $request->billing_notes;
                $billing_contact->org_name = "";
                $billing_contact->save();

            }

            if ( $contact->save()) {

                $securityAnswer = new SecurityAnswer();
                $securityAnswer->customer_id = $customerContact->id;
                $securityAnswer->question_id = $request->security_question;
                $securityAnswer->answer = $request->answer;
                $securityAnswer->save();

                return "Saved";

            }


        }


    }
}
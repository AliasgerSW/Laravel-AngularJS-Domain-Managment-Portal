<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\DomainDNS;
use Modules\Domain\Entities\Domain;
use Modules\Domain\API\ApiCall;
use Validator;

class DomainServerController extends Controller
{
    /**
     * Display a listing of the resource.
     * Parameters: domain_id, nameServers
     * @return Response
     */
    public function domainNameServers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'nameServers' => ['required','array',function($attribute, $value, $fail) {
                if (count($value) < 2) {
                    return $fail('You must have to add at least two name server.');
                }
            }]
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;
        $attributes['ns'] = $request->nameServers;

        $apiCall = new ApiCall;
        $result = $apiCall->modifyNameServer($domain->registrar, $attributes);

        if ($result['status'] == "SUCCESS"){
            $domainDNS = DomainDNS::where('domain_id', $request->domain_id)->first();
            $data = json_encode($request->nameServers);
            if (!is_null($domainDNS)){
                $update['ns_record'] = $data;
                $domainDNS->update($update);
            }else{
                $update['ns_record'] = $data;
                $update['domain_id'] = $request->domain_id;
                DomainDNS::create($update);
            }

            return response()->json(['success'=>__('admin.domain.domainNameServer')]);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, childNameServers
     * @return Response
     */
    public function domainChildNameServers(Request $request)
    {
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        Validator::extend('check_valid_domain', function($attr, $value){
            $array = explode(".",$value);
            $key = end($array);
            $key = key($array);

            $name = $array[$key];
            if ($key > 0){
                $name = $array[$key-1].'.'.$name;
            }

            $domain = Domain::find(request()->domain_id);
            if ($domain->domain_name != $name){
                return false;
            }
            return true;
        });

        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'hostname' => 'required|without_spaces|check_valid_domain',
            'ip' => 'required|ip'
        ],['check_valid_domain'=>'Please add valid host name.']);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $domainDNS = DomainDNS::where('domain_id', $request->domain_id)->first();
        $domain = Domain::find(request()->domain_id);

        $attributes['order-id'] = $domain->order_id;
        $attributes['cns'] = $request->hostname;
        $attributes['ip'] = $request->ip;

        $apiCall = new ApiCall;

        if (!is_null($domainDNS)){
            $data = json_decode($domainDNS->child_ns_record, true);
            if($request->has('id')){
                if (!isset($data[$request->id][$request->hostname])){
                    $attributes = [];
                    $attributes['order-id'] = $domain->order_id;
                    $attributes['old-cns'] = key($data[$request->id]);
                    $attributes['new-cns'] = $request->hostname;
                    $result = $apiCall->modifyChildNameServerHost($domain->registrar, $attributes);

                    if ($result['status'] == "SUCCESS"){
                        $data[$request->id] = [$request->hostname=>$data[$request->id][key($data[$request->id])]];
                        $update['child_ns_record'] = json_encode($data);
                        $domainDNS->update($update);
                    }else{
                        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
                    }
                }

                if ($data[$request->id][key($data[$request->id])] != $request->ip){
                    $attributes = [];
                    $attributes['order-id'] = $domain->order_id;
                    $attributes['cns'] = $request->hostname;
                    $attributes['old-ip'] = $data[$request->id][key($data[$request->id])];
                    $attributes['new-ip'] = $request->ip;
                    $result = $apiCall->modifyChildNameServerIP($domain->registrar, $attributes);

                    if ($result['status'] == "SUCCESS"){
                        $data[$request->id] = [$request->hostname=>$request->ip];
                        $update['child_ns_record'] = json_encode($data);
                        $domainDNS->update($update);
                    }else{
                        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
                    }
                }

                return response()->json(['success'=>__('admin.domain.domainChildNameServer')]);

            }else{

                $result = $apiCall->addChildNameServer($domain->registrar, $attributes);

                if ($result['status'] == "SUCCESS"){
                    $data[] = [$request->hostname=>$request->ip];
                    $update['child_ns_record'] = json_encode($data);
                    $domainDNS->update($update);
                    return response()->json(['success'=>__('admin.domain.domainChildNameServer')]);
                }
            }

        }else{

            $result = $apiCall->addChildNameServer($domain->registrar, $attributes);

            if ($result['status'] == "SUCCESS"){
                $update['child_ns_record'][] = [$request->hostname=>$request->ip];
                $update['child_ns_record'] = json_encode($update['child_ns_record']);
                $update['domain_id'] = $domain_id;
                DomainDNS::create($update);
                return response()->json(['success'=>__('admin.domain.domainChildNameServer')]);
            }
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    public function removeDomainChildNameServers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $domainDNS = DomainDNS::where('domain_id', $request->domain_id)->first();
        $domain = Domain::find(request()->domain_id);

        $attributes['order-id'] = $domain->order_id;

        $apiCall = new ApiCall;
        if (!is_null($domainDNS)){
            $data = json_decode($domainDNS->child_ns_record, true);
            if (isset($data[$request->id])){
                $attributes['cns'] = key($data[$request->id]);
                $attributes['ip'] = $data[$request->id][key($data[$request->id])];

                $result = $apiCall->deleteChildNameServer($domain->registrar, $attributes);
                if ($result['status'] == "SUCCESS"){
                    unset($data[$request->id]);
                    $update['child_ns_record'] = json_encode($data);
                    $domainDNS->update($update);
                    return response()->json(['success'=>__('admin.domain.domainChildNameServer')]);
                }else{
                    return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
                }
            }

        }

        return response()->json(['error'=>'Invalid Id you passed.']);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, key_tag, algoritham, digest_type, digest, max_signature_life, flags, protocol, key_data_algoritham, public_key
     * @return Response
     */
    public function domainDNSSEC(Request $request){
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'key_tag' => 'required|numeric',
            'algoritham' => 'required',
            'digest_type' => 'required',
            'digest' => 'required',
            'max_signature_life' => 'required',
            'flags' => 'required',
            'protocol' => 'required',
            'key_data_algoritham' => 'required',
            'public_key' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        // Write code for saving data
        $domainDNS = DomainDNS::where('domain_id', $request->domain_id)->first();
        if (!is_null($domainDNS)){
            $input = $request->all();
            unset($input['domain_id']);
            $update['dnssec_record'] = json_encode($input);
            $domainDNS->update($update);
        }else{
            $input = $request->all();
            unset($input['domain_id']);
            $update['dnssec_record'] = json_encode($input);
            $update['domain_id'] = $domain_id;
            DomainDNS::create($update);
        }

        return response()->json(['success'=>__('admin.domain.dnssec')]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, key_tag, algoritham, digest_type
     * @return Response
     */
    public function domainForwardingSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'dastination_protocol' => 'required',
            'destination_url' => 'required'
        ]);



        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }
    }

}

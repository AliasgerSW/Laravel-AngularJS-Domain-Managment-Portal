<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\Domain;
use Modules\Domain\API\ApiCall;
use Modules\Domain\Entities\DNSRecord;
use Modules\Domain\Entities\DomainDNS;
use Validator;

class DNSRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     * Parameters: domain_id, status
     * @return Response
     */
    public function addDNSRecords(Request $request)
    {
        if (!$request->has('type')){
            return response()->json(['error' => 'Type field is required.']);
        }

        switch ($request->type) {
            case "A":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required|ip',
                ];
                break;
            case "AAAA":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required|ip'
                ];
                break;
            case "MX":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                ];
                break;
            case "CNAME":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                ];
                break;
            case "NS":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                ];
                break;
            case "TXT":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                ];
                break;
            case "SRV":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                    'host' => 'required',
                ];
                break;
            case "SOA":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'responsible_name' => 'required',
                    'ttl' => 'required|numeric',
                    'serial' => 'numeric',
                    'retry' => 'numeric',
                    'refresh' => 'numeric',
                    'expire' => 'numeric'
                ];
                break;
            default:
                $validationRules = [
                    'domain_id' => 'required',
                    'type' => 'required|in:A,AAA,MX,CNAME,NS,TXT,SRV,SOA',
                ];
        }

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $modelObj = new DNSRecord();
        $input = $request->all();
        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;

        $apiCall = new ApiCall;
        $apiCall->activateDnsService($domain->registrar, $attributes);
        $attributes['domain-name'] = $request->hostname;
        //API Implement PArt
        switch ($request->type) {
            case "A":
                $attributes['value'] = $request->value;
                $result = $apiCall->addIpV4Record($domain->registrar, $attributes);
                break;
            case "AAAA":
                $attributes['value'] = $request->value;
                $result = $apiCall->addIpV6Record($domain->registrar, $attributes);
                break;
            case "MX":
                $attributes['value'] = $request->value;
                $result = $apiCall->addMxRecord($domain->registrar, $attributes);
                break;
            case "CNAME":
                $attributes['value'] = $request->value;
                $result = $apiCall->addCnameRecord($domain->registrar, $attributes);
                break;
            case "NS":
                $attributes['value'] = $request->value;
                $result = $apiCall->addNsRecord($domain->registrar, $attributes);
                break;
            case "TXT":
                $attributes['value'] = $request->value;
                $result = $apiCall->addTxtRecord($domain->registrar, $attributes);
                break;
            case "SRV":
                $attributes['value'] = $request->value;
                $attributes['host'] = $request->host;
                $result = $apiCall->addSrvRecord($domain->registrar, $attributes);
                break;
            case "SOA":
                $attributes['responsible-person'] = $request->responsible_name;
                $attributes['refresh'] = $request->refresh;
                $attributes['retry'] = $request->retry;
                $attributes['expire'] = $request->expire;
                $attributes['ttl'] = $request->ttl;
                $result = $apiCall->modifySoaRecord($domain->registrar, $attributes);
                break;
            default:
                $result = [];
        }

        if ($request->type == "SOA"){
            $domainDNS = DomainDNS::where('domain_id', $request->domain_id)->first();
            if(!is_null($domainDNS)){
                $domainDNS->soa_record = json_encode($request->all());
                $domainDNS->save();
                return response()->json(['success'=> __('admin.domain.dnsRecordAdd')]);
            }
        } else {
            if ($result['status'] == "SUCCESS"){
                $modelObj->create($input);
                return response()->json(['success'=> __('admin.domain.dnsRecordAdd')]);
            }
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, status
     * @return Response
     */
    public function editDNSRecords(Request $request)
    {
        if (!$request->has('type')){
            return response()->json(['error' => 'Type field is required.']);
        }

        switch ($request->type) {
            case "A":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required|ip',
                    'id' => 'required',
                ];
                break;
            case "AAAA":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required|ip',
                    'id' => 'required',
                ];
                break;
            case "MX":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                    'id' => 'required',
                ];
                break;
            case "CNAME":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                    'id' => 'required',
                ];
                break;
            case "NS":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                    'id' => 'required',
                ];
                break;
            case "TXT":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                    'id' => 'required',
                ];
                break;
            case "SRV":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'value' => 'required',
                    'host' => 'required',
                    'id' => 'required',
                ];
                break;
            case "SOA":
                $validationRules = [
                    'domain_id' => 'required',
                    'hostname' => 'required',
                    'responsible_name' => 'required',
                    'ttl' => 'required|numeric',
                    'serial' => 'numeric',
                    'retry' => 'numeric',
                    'refresh' => 'numeric',
                    'expire' => 'numeric'
                ];
                break;
            default:
                $validationRules = [
                    'domain_id' => 'required',
                    'type' => 'required|in:A,AAA,MX,CNAME,NS,TXT,SRV,SOA',
                ];
        }

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $modelObj = DNSRecord::where('id', $request->id)->where('type', $request->type)->first();

        if(is_null($modelObj)){
            return response()->json(['error'=> __('admin.domain.dnsRecordNotFound')]);
        }

        $input = $request->all();
        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;

        $apiCall = new ApiCall;
        $apiCall->activateDnsService($domain->registrar, $attributes);
        $attributes['domain-name'] = $request->hostname;
        //API Implement PArt
        switch ($request->type) {
            case "A":
                $attributes['new-value'] = $request->value;
                $attributes['current-value'] = $modelObj->value;
                $result = $apiCall->modifyIpV4Record($domain->registrar, $attributes);
                break;
            case "AAAA":
                $attributes['new-value'] = $request->value;
                $attributes['current-value'] = $modelObj->value;
                $result = $apiCall->modifyIpV6Record($domain->registrar, $attributes);
                break;
            case "MX":
                $attributes['new-value'] = $request->value;
                $attributes['current-value'] = $modelObj->value;
                $result = $apiCall->modifyMxRecord($domain->registrar, $attributes);
                break;
            case "CNAME":
                $attributes['new-value'] = $request->value;
                $attributes['current-value'] = $modelObj->value;
                $result = $apiCall->modifyCnameRecord($domain->registrar, $attributes);
                break;
            case "NS":
                $attributes['new-value'] = $request->value;
                $attributes['current-value'] = $modelObj->value;
                $result = $apiCall->modifyNsRecord($domain->registrar, $attributes);
                break;
            case "TXT":
                $attributes['new-value'] = $request->value;
                $attributes['current-value'] = $modelObj->value;
                $result = $apiCall->modifyTxtRecord($domain->registrar, $attributes);
                break;
            case "SRV":
                $attributes['new-value'] = $request->value;
                $attributes['current-value'] = $modelObj->value;
                $attributes['host'] = $request->host;
                $result = $apiCall->modifySrvRecord($domain->registrar, $attributes);
                break;
            case "SOA":
                $attributes['responsible-person'] = $request->responsible_name;
                $attributes['refresh'] = $request->refresh;
                $attributes['retry'] = $request->retry;
                $attributes['expire'] = $request->expire;
                $attributes['ttl'] = $request->ttl;
                $result = $apiCall->modifySoaRecord($domain->registrar, $attributes);
                break;
            default:
                $result = [];
        }

        if ($request->type == "SOA"){
            $domainDNS = DomainDNS::where('domain_id', $request->domain_id)->first();
            if(!is_null($domainDNS)){
                $domainDNS->soa_record = json_encode($request->all());
                $domainDNS->save();
                return response()->json(['success'=> __('admin.domain.dnsRecordEdit')]);
            }
        } else {
            if ($result['status'] == "SUCCESS"){
                $modelObj->value = $request->value;
                $modelObj->save();
                return response()->json(['success'=> __('admin.domain.dnsRecordEdit')]);
            }
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, status
     * @return Response
     */
    public function deleteDNSRecords(Request $request)
    {
        if (!$request->has('type')){
            return response()->json(['error' => 'Type field is required.']);
        }

        switch ($request->type) {
            case "A":
                $validationRules = [
                    'domain_id' => 'required',
                    'id' => 'required',
                ];
                break;
            case "AAAA":
                $validationRules = [
                    'domain_id' => 'required',
                    'id' => 'required',
                ];
                break;
            case "MX":
                $validationRules = [
                    'domain_id' => 'required',
                    'id' => 'required',
                ];
                break;
            case "CNAME":
                $validationRules = [
                    'domain_id' => 'required',
                    'id' => 'required',
                ];
                break;
            case "NS":
                $validationRules = [
                    'domain_id' => 'required',
                    'id' => 'required',
                ];
                break;
            case "TXT":
                $validationRules = [
                    'domain_id' => 'required',
                    'id' => 'required',
                ];
                break;
            case "SRV":
                $validationRules = [
                    'domain_id' => 'required',
                    'id' => 'required',
                ];
                break;
            default:
                $validationRules = [
                    'domain_id' => 'required',
                    'type' => 'required|in:A,AAA,MX,CNAME,NS,TXT,SRV,SOA',
                ];
        }

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $modelObj = DNSRecord::where('id', $request->id)->where('type', $request->type)->first();

        if(is_null($modelObj)){
            return response()->json(['error'=> __('admin.domain.dnsRecordNotFound')]);
        }

        $input = $request->all();
        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;

        $apiCall = new ApiCall;
        $apiCall->activateDnsService($domain->registrar, $attributes);
        $attributes['domain-name'] = $modelObj->hostname;
        $attributes['value'] = $modelObj->value;
        $attributes['host'] = '@';
        //API Implement PArt
        switch ($request->type) {
            case "A":
                $result = $apiCall->deleteIpV4Record($domain->registrar, $attributes);
                break;
            case "AAAA":
                $result = $apiCall->deleteIpV6Record($domain->registrar, $attributes);
                break;
            case "MX":
                $result = $apiCall->deleteMxRecord($domain->registrar, $attributes);
                break;
            case "CNAME":
                $result = $apiCall->deleteCnameRecord($domain->registrar, $attributes);
                break;
            case "NS":
                $result = $apiCall->deleteNsRecord($domain->registrar, $attributes);
                break;
            case "TXT":
                $result = $apiCall->deleteTxtRecord($domain->registrar, $attributes);
                break;
            case "SRV":
                $attributes['host'] = $modelObj->host;
                $attributes['port'] = 0;
                $attributes['weight'] = 0;
                $result = $apiCall->deleteSrvRecord($domain->registrar, $attributes);
                break;
            default:
                $result = [];
        }

        if ($result['status'] == "SUCCESS"){
            $modelObj->delete();
            return response()->json(['success'=> __('admin.domain.dnsRecordDelete')]);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

}

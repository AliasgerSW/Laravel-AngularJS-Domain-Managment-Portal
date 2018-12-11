<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\Domain;
use Modules\Domain\Entities\DomainForwarding;
use Modules\Domain\Entities\SubDomain;
use Modules\Domain\API\ApiCall;
use Validator;

class DomainProtectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * Parameters: domain_id, status
     * @return Response
     */
    public function theftProtection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;
        $status = $request->status == 1 ? true : false;

        $apiCall = new ApiCall;
        $result = $apiCall->changeTheftProtectionStatus($domain->registrar, $attributes, $status);

        if ($result['status'] == "SUCCESS"){
            $domain->theft_protection_status = $request->status;
            $domain->save();
            return response()->json(['success'=> __('admin.domain.theftProtection')]);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, domian_secret_key
     * @return Response
     */
    public function domainSecret(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'domian_secret_key' => 'required|min:6|max:16'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;
        $attributes['auth-code'] = $request->domian_secret_key;

        $apiCall = new ApiCall;
        $result = $apiCall->modifyDomainSecret($domain->registrar, $attributes);

        if ($result['status'] == "SUCCESS"){
            $domain->domian_secret_key = $request->domian_secret_key;
            $domain->save();
        }

        return response()->json(['success'=>__('admin.domain.domainSecret')]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, status
     * @return Response
     */
    public function privacyProtection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'status' => 'required|in:0,1',
            'reason' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;
        $attributes['protect-privacy'] = $request->status == 1 ? true : false;
        $attributes['reason'] = $request->reason;

        $apiCall = new ApiCall;
        $result = $apiCall->changePrivacyProtectionStatus($domain->registrar, $attributes);

        if ($result['status'] == "SUCCESS"){
            $domain->privacy_protection_status = $request->status;
            $domain->privacy_protection_reason = $request->reason;
            $domain->save();
            return response()->json(['success'=> __('admin.domain.privacyProtection')]);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, subdomain_name, source, destination_protocol, destination_url, url_masking, header_tags, page_content, path_forwarding, sub_domain_forwarding
     * @return Response
     */
    public function domainForwarding(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'destination_protocol' => 'required|in:http,https',
            'destination_url' => 'required',
            'source' => 'required',
            'url_masking' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $input = $request->all();
        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;
        $attributes['forward-to'] = $request->destination_url;
        $attributes['url-masking'] = $request->url_masking == 1 ? true : false;

        if ($request->has('header_tags')){
            $attributes['meta-tags'] = $request->header_tags;
        }

        if ($request->has('page_content')){
            $attributes['noframes'] = $request->page_content;
        }

        if ($request->has('sub_domain_forwarding')){
            $attributes['sub-domain-forwarding'] = $request->sub_domain_forwarding == 1 ? true : false;;
        }

        if ($request->has('path_forwarding')){
            $attributes['path-forwarding'] = $request->path_forwarding == 1 ? true : false;;
        }

        if($request->has('subdomain_name')){
            $attributes['sub-domain-prefix'] = $request->subdomain_name;
        }

        $apiCall = new ApiCall;
        $result = $apiCall->activateDomainForwarding($domain->registrar, $attributes);

        if ($result['status'] == "SUCCESS"){
            if($request->has('subdomain_name')){
                $subdomain = SubDomain::where('name', $request->subdomain_name)->first();
                if (is_null($subdomain)){
                    $subdomain = SubDomain::create(['domain_id'=>$request->domain_id, 'name'=>$request->subdomain_name]);
                }
                $input['subdomain_id'] = $subdomain->id;
            }

            DomainForwarding::create($input);

            return response()->json(['error' => ["type"=>"API", "message"=>__('admin.domain.forwardingAdd')]]);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, subdomain_name, source, destination_protocol, destination_url, url_masking, header_tags, page_content, path_forwarding, sub_domain_forwarding
     * @return Response
     */
    public function domainForwardingEdit(Request $request){
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'destination_protocol' => 'required|in:http,https',
            'destination_url' => 'required',
            'source' => 'required',
            'url_masking' => 'required|in:0,1',
            'id' => 'required'
        ]);

        $input = $request->all();
        $find = DomainForwarding::find($request->id);

        if (is_null($find)){
            return request()->json(['error'=>'Id is not valid']);
        }

        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;
        $attributes['forward-to'] = $request->destination_url;
        $attributes['url-masking'] = $request->url_masking == 1 ? true : false;

        if ($request->has('header_tags')){
            $attributes['meta-tags'] = $request->header_tags;
        }

        if ($request->has('page_content')){
            $attributes['noframes'] = $request->page_content;
        }

        if ($request->has('sub_domain_forwarding')){
            $attributes['sub-domain-forwarding'] = $request->sub_domain_forwarding == 1 ? true : false;;
        }

        if ($request->has('path_forwarding')){
            $attributes['path-forwarding'] = $request->path_forwarding == 1 ? true : false;;
        }

        if($request->has('subdomain_name')){
            $attributes['sub-domain-prefix'] = $request->subdomain_name;
        }

        $apiCall = new ApiCall;
        $result = $apiCall->modifyDomainForwarding($domain->registrar, $attributes);

        if ($result['status'] == "SUCCESS"){
            $find->update($input);
            return response()->json(['success'=>__('admin.domain.forwardingEdit')]);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

    /**
     * Display a listing of the resource.
     * Parameters: domain_id, subdomain_name, source, destination_protocol, destination_url, url_masking, header_tags, page_content, path_forwarding, sub_domain_forwarding
     * @return Response
     */
    public function domainForwardingDelete(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        $input = $request->all();
        $find = DomainForwarding::find($request->id);

        if (!is_null($find)){
            $find->delete();
        }else{
            return request()->json(['error'=>'Id is not valid']);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>__('admin.domain.forwardingDelete')]]);
    }



    /**
     * Display a listing of the resource.
     * Parameters: domain_id, status
     * @return Response
     */
    public function domainGDPRProtection(Request $request){
        $validator = Validator::make($request->all(), [
            'domain_id' => 'required',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()]);
        }

        $domain = Domain::find($request->domain_id);
        $attributes['order-id'] = $domain->order_id;

        $apiCall = new ApiCall;
        if ($request->status == 1){
            $result = $apiCall->enableGdprProtection($domain->registrar, $attributes);
        }else{
            $result = $apiCall->disableGdprProtection($domain->registrar, $attributes);
        }

        if ($result['status'] == "SUCCESS"){
            $domain->gdpr_protection = $request->status;
            $domain->save();
            return response()->json(['success'=> __('admin.domain.gdprProtection')]);
        }

        return response()->json(['error' => ["type"=>"API", "message"=>$result['message']]]);
    }

}

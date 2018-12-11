<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Payments\Entities\PaymentConfig;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
       $methods = PaymentConfig::all()->groupBy('method_name');

      ;

        return view('payments::index',compact('methods'));
    }


    public function settings()
    {
        $methods = PaymentConfig::all();
        return view('payments::setting',compact('methods'));
    }


    public function amount(Request $request)
    {
        PaymentConfig::find($request->method_id)->update(['amount'=>$request->amount]);
        return "sucess";
    }

    public function percent(Request $request)
    {
        PaymentConfig::find($request->method_id)->update(['percent'=>$request->percent]);
    }

    public function changeStatus(Request $request)
    {
        PaymentConfig::find($request->method_id)->update(['status'=>$request->status]);
    }
}

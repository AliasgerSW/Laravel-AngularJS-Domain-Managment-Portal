<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\Domain;
use Modules\Domain\Entities\DomainDNS;
use Modules\Domain\Entities\DomainForwarding;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $domains = Domain::paginate(20);
        return view('domain::domains.index', compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('domain::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Domain $domain)
    {
        return view('domain::domains.show', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('domain::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function singleDomain($id)
    {
        $id = (int) $id;
        $dns_records = DomainDNS::where(['domain_id' => $id]);
        $dfs = DomainForwarding::where(['domain_id' => $id])->get();
        $domain = Domain::find($id);
        return view('domain::domains.detail', compact('domain', 'dfs', 'id'));
    }
}

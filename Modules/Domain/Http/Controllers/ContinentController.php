<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\Continent;

class ContinentController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $continents = Continent::pluck('name','id');
            return $continents;
        }
    }
}

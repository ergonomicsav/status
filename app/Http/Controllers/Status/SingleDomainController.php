<?php

namespace App\Http\Controllers\Status;

use Illuminate\Http\Request;

class SingleDomainController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($nameDomain = null)
    {
        return view('Admin.domain', compact('nameDomain'));
    }
}

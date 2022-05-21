<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class BranchController extends BaseController
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

    public function index(){
        return view('web.branch.index');
    }
}

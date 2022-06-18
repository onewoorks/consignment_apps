<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ReportController extends BaseController
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

    public function index_mob(){
        return view('mob.report.index');
    }

    public function index(){
        return view('web.report.index');
    }
}

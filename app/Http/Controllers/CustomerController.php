<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class CustomerController extends BaseController
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
        return view('mob.customer.index');
    }

    public function register(){
        return view('mob.customer.register');
    }

    public function profile(){
        return view('mob.customer.profile');
    }
}

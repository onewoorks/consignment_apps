<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class TeamController extends BaseController
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


}

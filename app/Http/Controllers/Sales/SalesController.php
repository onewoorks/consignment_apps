<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\BusinessProcesses\SalesProcess;

class SalesController extends Controller {
    
    public function createSales(Request $request){
        $data = json_decode($request->getContent());
        $bp = SalesProcess::salesFlow($data);
    }

}

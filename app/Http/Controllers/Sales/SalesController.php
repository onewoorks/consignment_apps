<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\BusinessProcesses\SalesProcess;
use App\Http\Controllers\Resit\PrinterController as Printer;

class SalesController extends Controller {
    
    public function createSales(Request $request){
        $data = json_decode($request->getContent());
        $bp = SalesProcess::salesFlow($data);
    }

    public function getSalesResit(Request $request){
        $printer = new Printer();
        $data = $printer->getSales($request->no_resit);
        return $data;
    }

}

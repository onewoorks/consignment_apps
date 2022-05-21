<?php 

namespace App\BusinessProcesses;
use App\Http\Controllers\Resit\PrinterController as Printer;

class SalesProcess {

    public static function salesFlow($payload){
        $process = new SalesProcess();
        //create transaction 
        //create sales data
        $process->prepareResitPrint($payload);
        // ->prepareResitPrint();
    }

    public function prepareResitPrint($data){
        $printer = new Printer();
        $printer->getSales(1);
    }

}
<?php

namespace App\BusinessProcesses;
use App\Models\Task;
use App\Models\Team;
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

        $task = Task::findOrFail($data->task_id);
        $team = Team::findOrFail($task->team_id);
        $printer->getSales(1);
    }

}

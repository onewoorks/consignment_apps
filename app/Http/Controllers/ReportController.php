<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\InventoryExport;
use Maatwebsite\Excel\Facades\Excel;
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

    public function index_mob()
    {
        $years = array();
        array_push($years, 2022);
        array_push($years, 2023);
        array_push($years, 2024);
        array_push($years, 2025);
        return view('mob.report.index', ['years' => $years]);
    }

    public function index()
    {
        return view('web.report.index');
    }

    public function export(Request $request)
    {

        $yr = $request->reportyear;

        return Excel::download(new InventoryExport($yr, ''), 'report.xlsx');
    }

    public function exportByUser($user, Request $request)
    {

        $yr = $request->reportyear;

        return Excel::download(new InventoryExport($yr, $user), 'report.xlsx');
    }
}

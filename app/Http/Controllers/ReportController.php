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
        return view('mob.report.index', ['years' => $this->getYears()]);
    }

    public function index()
    {
        return view('web.report.index', ['years' => $this->getYears(), 'months' => $this->getMonths()]);
    }

    public function getYears()
    {
        $years = [
            2022, 2023, 2024, 2025
        ];

        return json_decode(json_encode($years));
    }

    public function getMonths()
    {
        $months = [
            ['key' => 1, 'name' => 'January'],
            ['key' => 2, 'name' => 'February'],
            ['key' => 3, 'name' => 'March'],
            ['key' => 4, 'name' => 'April'],
            ['key' => 5, 'name' => 'May'],
            ['key' => 6, 'name' => 'June'],
            ['key' => 7, 'name' => 'July'],
            ['key' => 8, 'name' => 'August'],
            ['key' => 9, 'name' => 'September'],
            ['key' => 10, 'name' => 'October'],
            ['key' => 11, 'name' => 'November'],
            ['key' => 12, 'name' => 'December']
        ];

        return json_decode(json_encode($months));
    }

    public function export(Request $request)
    {

        $yr = $request->reportyear;
        $mth = $request->reportyear;

        return Excel::download(new InventoryExport($yr, '', $mth), 'report.xlsx');
    }

    public function exportByUser($user, Request $request)
    {

        $yr = $request->reportyear;

        return Excel::download(new InventoryExport($yr, $user, null), 'report.xlsx');
    }
}

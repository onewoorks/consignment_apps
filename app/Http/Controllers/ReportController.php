<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\InventoryExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function index(Request $request)
    {
        $data = json_decode(json_encode($request->session()->all()));

        return view('web.report.index', [
            'years' => $this->getYears(), 'months' => $this->getMonths(),
            'response' => isset($data->response) ? json_decode($data->response) : array()
        ]);
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
        $mth = $request->reportmonth;

        $sql = "select ";
        $sql .= "month(ki.created_at) imonth, ";
        $sql .= "day(ki.created_at) iday,  ";
        $sql .= "date(ki.created_at) idate, ";
        $sql .= "(sum(case when ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_sale_nasty, ";
        $sql .= "(sum(case when ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_sale_akso, ";
        $sql .= "(sum(case when ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_sale_nasty, ";
        $sql .= "(sum(case when ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_sale_akso, ";
        $sql .= "(sum(case when kt.team_id = 1 and ki.region = 'KT' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_kt_zrox_nasty, ";
        $sql .= "(sum(case when kt.team_id = 1 and ki.region = 'KT' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_kt_zrox_akso, ";
        $sql .= "(max(case when kt.team_id = 1 and ki.region = 'KT' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.price_per_unit  else 0 end)) d_prcp_unit_kt_zrox_nasty, ";
        $sql .= "(max(case when kt.team_id = 1 and ki.region = 'KT' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.price_per_unit else 0 end)) d_prcp_unit_kt_zrox_akso, ";
        $sql .= "(sum(case when kt.team_id = 1 and ki.region = 'KT' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_kt_zrox_nasty, ";
        $sql .= "(sum(case when kt.team_id = 1 and ki.region = 'KT' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_kt_zrox_akso, ";
        $sql .= "(sum(case when kt.team_id = 2 and ki.region = 'KMM' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_kmm_bvr_nasty, ";
        $sql .= "(sum(case when kt.team_id = 2 and ki.region = 'KMM' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_kmm_bvr_akso, ";
        $sql .= "(max(case when kt.team_id = 2 and ki.region = 'KMM' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.price_per_unit  else 0 end)) d_prcp_unit_kmm_bvr_nasty, ";
        $sql .= "(max(case when kt.team_id = 2 and ki.region = 'KMM' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.price_per_unit else 0 end)) d_prcp_unit_kmm_bvr_akso, ";
        $sql .= "(sum(case when kt.team_id = 2 and ki.region = 'KMM' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_kmm_bvr_nasty, ";
        $sql .= "(sum(case when kt.team_id = 2 and ki.region = 'KMM' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_kmm_bvr_akso, ";
        $sql .= "(sum(case when kt.team_id = 3 and ki.region = 'BS' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_bs_tt_nasty, ";
        $sql .= "(sum(case when kt.team_id = 3 and ki.region = 'BS' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_bs_tt_akso, ";
        $sql .= "(max(case when kt.team_id = 3 and ki.region = 'BS' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.price_per_unit  else 0 end)) d_prcp_unit_bs_tt_nasty, ";
        $sql .= "(max(case when kt.team_id = 3 and ki.region = 'BS' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.price_per_unit else 0 end)) d_prcp_unit_bs_tt_akso, ";
        $sql .= "(sum(case when kt.team_id = 3 and ki.region = 'BS' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_bs_tt_nasty, ";
        $sql .= "(sum(case when kt.team_id = 3 and ki.region = 'BS' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_bs_tt_akso, ";
        $sql .= "(sum(case when kt.team_id = 4 and ki.region = 'DG' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_dg_sd_nasty, ";
        $sql .= "(sum(case when kt.team_id = 4 and ki.region = 'DG' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_dg_sd_akso, ";
        $sql .= "(max(case when kt.team_id = 4 and ki.region = 'DG' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.price_per_unit  else 0 end)) d_prcp_unit_dg_sd_nasty, ";
        $sql .= "(max(case when kt.team_id = 4 and ki.region = 'DG' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.price_per_unit else 0 end)) d_prcp_unit_dg_sd_akso, ";
        $sql .= "(sum(case when kt.team_id = 4 and ki.region = 'DG' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_dg_sd_nasty, ";
        $sql .= "(sum(case when kt.team_id = 4 and ki.region = 'DG' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_dg_sd_akso, ";
        $sql .= "(sum(case when kt.team_id = 5 and ki.region = 'VST' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_vst_st_nasty, ";
        $sql .= "(sum(case when kt.team_id = 5 and ki.region = 'VST' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.quantity else 0 end)) d_tot_unit_vst_st_akso, ";
        $sql .= "(max(case when kt.team_id = 5 and ki.region = 'VST' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.price_per_unit  else 0 end)) d_prcp_unit_vst_st_nasty, ";
        $sql .= "(max(case when kt.team_id = 5 and ki.region = 'VST' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.price_per_unit else 0 end)) d_prcp_unit_vst_st_akso, ";
        $sql .= "(sum(case when kt.team_id = 5 and ki.region = 'VST' and ki.product_code = 'NFIX' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_vst_st_nasty, ";
        $sql .= "(sum(case when kt.team_id = 5 and ki.region = 'VST' and ki.product_code = 'AKSO' and ki.stock_flow = 'OUT' then ki.total_price else 0 end)) d_tot_price_vst_st_akso ";
        $sql .= "from kh_inventories ki  ";
        $sql .= "left join kh_customers kc on kc.id = ki.shop_id  ";
        $sql .= "left join kh_task_assignments kta on ki.route_id = kta.id  ";
        $sql .= "join kh_tasks kt on kta.task_id = kt.id ";
        $sql .= "where year(ki.created_at) = ? ";

        if ($mth != null && $mth != '') {
            $sql .= "and month(ki.created_at) = " . $mth;
        }

        $sql .= " group by month(ki.created_at), day(ki.created_at), date(ki.created_at)";
        $sql .= " order by month(ki.created_at), day(ki.created_at), date(ki.created_at)";


        $response = collect(DB::select($sql, [$yr]));
        return redirect('web/report')->with('response', json_encode($response));

        // return Excel::download(new InventoryExport($yr, '', $mth), 'report.xlsx');
    }

    public function exportByUser($user, Request $request)
    {

        $yr = $request->reportyear;

        return Excel::download(new InventoryExport($yr, $user, null), 'report.xlsx');
    }
}

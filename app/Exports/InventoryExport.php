<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryExport implements FromCollection, WithHeadings
{

    public function __construct(int $year, string $user, int $month = null)
    {
        $this->year = $year;
        $this->user = $user;
        $this->month = $month;
    }

    public function collection()
    {
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

        if ($this->user != null && $this->user != '') {
            $sql .= "and ki.created_by = '" . $this->user . "'";
        }

        if ($this->month != null && $this->month != '') {
            $sql .= " and month(ki.created_at) = " . $this->month;
        }

        $sql .= " group by month(ki.created_at), day(ki.created_at), date(ki.created_at)";
        $sql .= " order by month(ki.created_at), day(ki.created_at), date(ki.created_at)";

        Log::info($sql);

        return  collect(DB::select($sql, [$this->year]));
    }

    public function headings(): array
    {
        return [
            "MONTH", "DAY", "DATE", "DAILY TOTAL RM SALE NASTY", "DAILY TOTAL RM SALE AKSO", "DAILY TOTAL UNIT SALE NASTY", "DAILY TOTAL UNIT SALE AKSO",
            "TOTAL UNIT ZROW KT NFIX", "TOTAL UNIT ZROW KT AKSO", "UNIT PRICE ZROW KT NFIX", "UNIT PRICE ZROW KT AKSO", "TOTAL RM ZROW KT NFIX", "TOTAL RM ZROW KT AKSO",
            "TOTAL UNIT BVR KMM NFIX", "TOTAL UNIT BVR KMM AKSO", "UNIT PRICE BVR KMM NFIX", "UNIT PRICE BVR KMM AKSO", "TOTAL RM BVR KMM NFIX", "TOTAL RM BVR KMM AKSO",
            "TOTAL UNIT TTWO BS NFIX", "TOTAL UNIT TTWO BS AKSO", "UNIT PRICE TTWO BS NFIX", "UNIT PRICE TTWO BS AKSO", "TOTAL RM TTWO BS NFIX", "TOTAL RM TTWO BS AKSO",
            "TOTAL UNIT SUDENG DG NFIX", "TOTAL UNIT SUDENG DG AKSO", "UNIT PRICE SUDENG DG NFIX", "UNIT PRICE SUDENG DG AKSO", "TOTAL RM SUDENG DG NFIX", "TOTAL RM SUDENG DG AKSO",
            "TOTAL UNIT STERN VST NFIX", "TOTAL UNIT STERN VST AKSO", "UNIT PRICE STERN VST NFIX", "UNIT PRICE STERN VST AKSO", "TOTAL RM STERN VST NFIX", "TOTAL RM STERN VST AKSO"
        ];
    }
}

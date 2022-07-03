<?php

namespace App\Exports;

use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class InventoryExport implements FromCollection, WithHeadings
{

    public function __construct(int $year, string $user)
    {
        $this->year = $year;
        $this->user = $user;
    }

    public function collection()
    {
        $sql = "select day(ki.created_at) inventory_day, date(ki.created_at) inventory_date, kc.shop_name, ki.shop_status, kc.region, ki.product_code, ";
        $sql .= "    sum(case when stock_flow = 'OUT' then ki.quantity else 0 end) total_units, ";
        $sql .= "    sum(case when stock_flow = 'OUT' then ki.total_price else 0 end) total_amounts ";
        $sql .= "from kh_inventories ki left join kh_customers kc on kc.id = ki.shop_id ";
        $sql .= "where year(ki.created_at) = ? ";
        $sql .= "and 1 = (case when ? is null then 1 when ki.created_by = ? then 1 else 0 end) ";
        $sql .= "group by day(ki.created_at), date(ki.created_at), kc.shop_name, ki.shop_status, kc.region, ki.product_code";

        return  collect(DB::select($sql, [$this->year, $this->user, $this->user]));
    }

    public function headings(): array
    {
        return ["INVENTORY DAY", "INVENTORY DATE", "SHOP NAME", "SHOP STATUS", "REGION", "PRODUCT", "TOTAL UNITS", "TOTAL AMOUNTS (RM)"];
    }
}

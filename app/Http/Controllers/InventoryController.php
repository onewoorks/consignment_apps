<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Constants\StockFlowConstant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class InventoryController extends BaseController
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

    public function store(Request $request)
    {
        $stock_outs = $request->stock_outs;
        $this->process_stock_flow($stock_outs, StockFlowConstant::OUT);

        $stock_ins = $request->stock_ins;
        $this->process_stock_flow($stock_ins, StockFlowConstant::IN);

        return 'Success, Done maintained the stock!';
    }

    private function process_stock_flow($stocks = [], $flow)
    {
        $crtBy = Auth::user()->name;
        foreach ($stocks as $stock) {
            $pstock = json_decode(json_encode($stock));
            $quantity = 0;
            if (StockFlowConstant::IN === $flow) {
                $quantity = intval($pstock->qty_stock_in);
            } else {
                $quantity = intval($pstock->qty_stock_out);
            }

            if ($this->validate_stock_inout($quantity)) {
                $inventory = new Inventory();
                $inventory->shop_id = $pstock->shop_id;
                $inventory->region = $pstock->region;
                $inventory->product_code = $pstock->product_code;
                $inventory->product_name = $pstock->product->product_name;
                $inventory->stock_flow = $flow;
                $inventory->quantity = $quantity;
                $inventory->price_per_unit = $pstock->price_per_unit;
                $inventory->total_price = $quantity * $pstock->price_per_unit;
                $inventory->created_by = $crtBy;
                $inventory->save();

                $catalog = Catalog::findOrFail($pstock->id);

                $available_stock = 0;
                if ($flow === StockFlowConstant::IN) {
                    $available_stock += $quantity;
                } else if ($flow === StockFlowConstant::OUT) {
                    $available_stock -= $quantity;
                }

                $catalog->available_stock = $available_stock;
                $catalog->updated_by = $crtBy;
                $catalog->save();
            }
        }
    }

    private function validate_stock_inout($qty)
    {
        if ($qty != null && $qty > 0) {
            return true;
        }

        return false;
    }
}

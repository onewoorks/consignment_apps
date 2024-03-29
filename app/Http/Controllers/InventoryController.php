<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\BranchInventory;
use Illuminate\Support\Facades\Log;
use App\Constants\StockFlowConstant;
use App\Models\TaskAssignment;
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

    public function index($user)
    {
        $inventories = Inventory::select('kh_inventories.*', 'kh_customers.shop_name')
            ->join('kh_customers', 'kh_customers.id', '=', 'kh_inventories.shop_id')
            ->where('kh_inventories.created_by', $user)
            ->whereDate('kh_inventories.created_at', '=', Carbon::now())
            ->get();

        return view('mob.inventory.index', ['inventories' => $inventories, 'shops' => $this->distinctShopByUser('mob')]);
    }

    public function windex()
    {
        $inventories = Inventory::select('kh_inventories.*', 'kh_customers.shop_name')
            ->join('kh_customers', 'kh_customers.id', '=', 'kh_inventories.shop_id')
            ->whereDate('kh_inventories.created_at', '=', Carbon::now())
            ->get();

        return view('web.inventory.index', ['inventories' => $inventories, 'shops' => $this->distinctShopByUser('web')]);
    }

    private function distinctShopByUser($channel)
    {
        $query = Inventory::select('kh_customers.id', 'kh_customers.shop_name')
            ->join('kh_customers', 'kh_customers.id', '=', 'kh_inventories.shop_id');

        if ($channel === 'mob') {
            $query = $query->where('kh_inventories.created_by', Auth::user()->name);
        }

        $query = $query->distinct();

        return $query->get();
    }

    public function filter(Request $request)
    {
        $query = Inventory::select('kh_inventories.*', 'kh_customers.shop_name')
            ->join('kh_customers', 'kh_customers.id', '=', 'kh_inventories.shop_id')
            ->whereDate('kh_inventories.created_at', '=', $request->inventorydt);

        $channel = 'web';
        if (!isset($request->channel)) {
            $channel = 'mob';
            $query = $query->where('kh_inventories.created_by', Auth::user()->name);
        }

        if ($request->shop_id != null && $request->shop_id != '') {
            $query = $query->where('kh_inventories.shop_id', $request->shop_id);
        }

        $inventories = $query->get();

        return view($request->channel . '.inventory.index', ['inventories' => $inventories, 'shops' => $this->distinctShopByUser($channel)]);
    }

    public function store(Request $request)
    {
        $stock_outs = $request->stock_outs;
        $this->process_stock_flow($stock_outs, StockFlowConstant::OUT, $request->route_id);

        $stock_ins = $request->stock_ins;
        $this->process_stock_flow($stock_ins, StockFlowConstant::IN, $request->route_id);

        $taskassign = TaskAssignment::findOrFail($request->route_id);
        $taskassign->status = 'C';
        $taskassign->updated_by = Auth::user()->name;
        $taskassign->save();

        return 'Success, Done maintained the stock!';
    }

    private function process_stock_flow($stocks = [], $flow, $routeid)
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
                $inventory->route_id = $routeid;
                $inventory->save();

                $catalog = Catalog::findOrFail($pstock->id);

                $available_stock = $catalog->available_stock;
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

    public function branchInventoryIndex()
    {
        $branchInvtries = BranchInventory::all();
        if ($branchInvtries) {
            foreach ($branchInvtries as $i) {
                $branch = Branch::where('branch_code', $i->branch_code)->first();
                $i->branch_name = $branch->branch_name;
                $prod = Product::where('product_code', $i->product_code)->first();
                $i->product_name = $prod->product_name;
            }
        }

        return view('web.branch.inventory.index', [
            'inventories' => $branchInvtries,
            'branches' => Branch::all(),
            'products' => Product::all()
        ]);
    }

    public function createBranchInventory(Request $request)
    {
        $data = $request->all();
        $data['total_price'] = number_format($request->quantity * $request->price_per_unit, 2);
        $data['created_by'] = Auth::user()->name;
        $data['updated_by'] = Auth::user()->name;
        $response = BranchInventory::create($data);
        return redirect('web/branch/inventory')->with('response', json_encode($response));
    }

    public function updateBranchInventory(Request $request)
    {
        $branch = BranchInventory::findOrFail($request->id);
        $branch->total_price = number_format($request->quantity * $request->price_per_unit, 2);
        $branch->updated_by = Auth::user()->name;
        $branch->update($request->all());

        return redirect('web/branch/inventory')->with('response', json_encode($branch));
    }

    public function deleteBranchInventory(Request $request)
    {
        $branch = BranchInventory::findOrFail($request->brninvid);
        $branch->delete();

        return redirect('web/branch/inventory')->with('response', json_encode($branch));
    }
}

<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BranchInventory;

class ApiInventoryController extends Controller
{

    public function validateStockAtBranchInventory(Request $request)
    {

        $brnInv = BranchInventory::where('branch_code', $request->branch)->where('product_code', $request->product)->first();

        if($brnInv != null){
            if ($request->quantity <= $brnInv['quantity'] ) {
                return 1;
            }
        }

        return 0;
    }
}

<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

trait ProductService
{
    public function getProductNotYetAvailableInCustomerShop($shop_id)
    {
        return Product::select('*')->whereNotIn('product_code', function ($query) use($shop_id) {
            $query->select('product_code')->from('kh_catalogs')->where('shop_id', $shop_id);
        })->get();
    }
}

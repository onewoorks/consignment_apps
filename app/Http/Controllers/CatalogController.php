<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Traits\ProductService;
use Illuminate\Routing\Controller as BaseController;

class CatalogController extends BaseController
{
    use ProductService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        $catalog = Catalog::create($request->all());
        $customer = Customer::findOrFail($request->shop_id);
        $catalogs = Catalog::where('shop_id', $customer->id)->get();

        if (isset($catalogs) && count($catalogs) > 0) {
            foreach ($catalogs as $catalog) {
                $product = Product::where('product_code', $catalog->product_code)->first();
                $catalog->product = $product;
            }

            $customer->catalogs = $catalogs;
        }

        $products = $this->getProductNotYetAvailableInCustomerShop($request->shop_id);

        return view('mob.customer.wizard', ['customer' => $customer, 'catalog' => $catalog, 'products' => $products, 'task' => Task::findOrFail($request->task_id), 'route_id' => $request->shop_id]);
    }
}

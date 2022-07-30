<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\LovService as Lov;

class ProductController extends Controller
{
    use Lov;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $prodctgry = Lov::getLovByCodeCategory('PRODUCT_CATEGORY');
        $products = Product::all();
        if ($products) {
            foreach ($products as $product) {
                $product->product_category = Lov::getLovNameByCdCtgryAndCode('PRODUCT_CATEGORY', $product->product_category);
            }
        }

        return view('web.product.index', ['products' => $products, 'prod_categories' => $prodctgry]);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function create(Request $request)
    {
        $response = Product::create($request->all());
        return redirect('web/product')->with('response', json_encode($response));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('web/product')->with('response', json_encode($product));
    }

    public function delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('web/product')->with('response', json_encode($product));
    }
}

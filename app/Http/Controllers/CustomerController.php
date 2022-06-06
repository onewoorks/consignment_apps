<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\Customer;
use App\Traits\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class CustomerController extends BaseController
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

    public function index()
    {
        return view('mob.customer.index');
    }

    public function view()
    {
        return view('mob.customer.register');
    }

    public function register(Request $request)
    {
        try {
            $fileName = $request->shop_name;
            $destinationPath = '/uploads/';
            $shop_img_path =  $destinationPath . $fileName;

            $customer = new Customer();
            $customer->shop_name = $request->shopname;
            $customer->region = $request->region;
            $customer->address = $request->address;
            $customer->owner = $request->owner;
            $customer->phone_number = $request->phoneno;
            $customer->latitude = $request->latitude;
            $customer->longitude = $request->longitude;
            $customer->shop_image = $shop_img_path;
            $customer->save();
            $data = ['status' => 1,  'msg' =>  'Customer successfully saved.', 'shop_id' => $customer->getKey()];
        } catch (Exception $e) {
            Log::error($e);
            $data = ['status' => 0,  'msg' =>  'Failed - ' . $e->getMessage(), 'shop_id' => ''];
        }

        return view('mob.customer.register', $data);
    }

    public function getCustomersByUser(Request $request)
    {
        try {
            $user = Auth::user()->name;

            Customer::findByRegion();
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function upload(Request $request)
    {
        try {
            $file = $request->file;
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/uploads/';
            $file->move($destinationPath, $fileName);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function delete_uploaded_img(Request $request)
    {
        $filename =  $request->get('filename');
        Customer::where('shop_image', $filename)->delete();
        $path = public_path('uploads/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }

    public function profile($id)
    {
        $customer = Customer::findOrFail($id);
        $catalogs = Catalog::where('shop_id', $customer->id)->get();

        if (isset($catalogs) && count($catalogs) > 0) {
            foreach ($catalogs as $catalog) {
                $product = Product::where('product_code', $catalog->product_code)->first();
                $catalog->product = $product;
            }

            $customer->catalogs = $catalogs;
        }

        $products = $this->getProductNotYetAvailableInCustomerShop($customer->id);

        return view('mob.customer.wizard', ['customer' => $customer, 'products' => $products]);
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class ShopController extends BaseController
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

    public function index()
    {
        $shops = Customer::all();
        return view('web.shop.index', ['shops' => $shops]);
    }

    public function addShop()
    {
        return view('web.shop.create', ['branches' => Branch::all()]);
    }

    public function save(Request $request)
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
            $data = ['status' => 1,  'msg' =>  'Shop successfully saved.', 'shop_id' => $customer->getKey()];
        } catch (Exception $e) {
            Log::error($e);
            $data = ['status' => 0,  'msg' =>  'Failed - ' . $e->getMessage(), 'shop_id' => ''];
        }

        return redirect('web/shop')->with('response', json_encode($data));
    }

    public function editShop($id)
    {
        $shop = Customer::findOrFail($id);
        return view('web.shop.update', ['shop' => $shop, 'branches' => Branch::all()]);
    }

    public function update(Request $request)
    {
        $fileName = $request->shop_name;
        $destinationPath = '/uploads/';
        $shop_img_path =  $destinationPath . $fileName;

        $shop = Customer::findOrFail($request->shop_id);
        $shop->shop_image = $shop_img_path;
        $shop->update($request->all());

        return redirect('web/shop')->with('response', json_encode($shop));
    }

    public function delete(Request $request)
    {
        $shop = Customer::findOrFail($request->shopid);
        $shop->delete();

        return redirect('web/shop')->with('response', json_encode($shop));
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
}

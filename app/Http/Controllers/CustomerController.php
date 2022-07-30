<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Traits\ProductService;
use Illuminate\Support\Facades\DB;
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

    public function list($user, Request $request)
    {
        try {
            $customers = Customer::join('kh_task_assignments', 'kh_task_assignments.shop_id', '=', 'kh_customers.id')
                ->join('kh_tasks', 'kh_tasks.id', '=', 'kh_task_assignments.task_id')
                ->join('kh_task_users', 'kh_task_users.task_id', '=', 'kh_tasks.id')
                ->where('kh_task_users.user_id', $user)
                ->select('kh_customers.*', 'kh_tasks.id as task_id', 'kh_tasks.task_name', 'kh_task_assignments.id as route_id')
                ->get();

            $custs = array();
            if (count($customers) > 0) {
                foreach ($customers as $customer) {
                    $products = Catalog::where('shop_id', $customer->id)->get();
                    if (count($products) > 0) {
                        $total_stock = 0;
                        $total_amount = 0;
                        foreach ($products as $product) {
                            $total_stock += $product->available_stock;
                            $total_amount += $product->available_stock * $product->price_per_unit;
                        }

                        $customer->total_stock = $total_stock;
                        $customer->total_amount = $total_amount;
                    }

                    if (isset($request->search) && str_contains($customer->shop_name, $request->search)) {
                        array_push($custs, $customer);
                    }
                }
            }
        } catch (Exception $e) {
            Log::error($e);
            $customers = [];
            $custs = [];
        }

        return view('mob.customer.index', ['customers' => isset($request->search) ? $custs : $customers]);
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

    public function profile($task_id, $route_id, $id)
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

        return view('mob.customer.wizard', ['customer' => $customer, 'products' => $products, 'task' => Task::findOrFail($task_id), 'route_id' => $route_id]);
    }
}

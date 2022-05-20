<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Lov;
use Illuminate\Http\Request;
use App\Constants\DBConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class LovController extends BaseController {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function create(Request $request) {
        $response = [];
        try {
            $lov = new Lov();
            $lov->lov_category = $request->lovCategory;
            $lov->lov_code = $request->lovCode;
            $lov->lov_description = $request->lovDescription;
            $lov->remarks = $request->remarks;
            $lov->is_required = $request->isRequired;
            $lov->is_default = $request->isDefault;
            $lov->created_date = Carbon::now();
            $lov->save();

            $response = ['status' => 'Success', 'message' => 'Lov successfully saved.'];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            $response = ['status' => 'Error', 'message' => $e->getMessage()];
        }
        return redirect('lov')->with('response', json_encode($response));
    }

    public function update(Request $request) {
        $response = [];
        try {
            $lov = Lov::find($request->id);
            $lov->lov_category = $request->lovCategory;
            $lov->lov_code = $request->lovCode;
            $lov->lov_description = $request->lovDescription;
            $lov->remarks = $request->remarks;
            $lov->is_required = $request->isRequired;
            $lov->is_default = $request->isDefault;
            $lov->last_updated = Carbon::now();
            $lov->save();

            $response = ['status' => 'Success', 'message' => 'Lov successfully updated.'];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            $response = ['status' => 'Error', 'message' => $e->getMessage()];
        }
        return redirect('lov')->with('response', json_encode($response));
    }

    public function delete(Request $request) {
        $response = [];
        try {
            $lov = Lov::find($request->lovid);
            $lov->delete();
            $response = ['status' => 'Success', 'message' => 'Lov Successfully Deleted.'];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            $response = ['status' => 'Error', 'message' => $e->getMessage()];
        }
        return redirect('lov')->with('response', json_encode($response));
    }

    public function getLovs(Request $request) {
        try {
            if ($request->lovCategory != null && $request->code != null) {
                $allLov = Lov::where('lov_category', $request->lovCategory)->where('lov_code', $request->code)->get();
            } else if ($request->lovCategory != null) {
                $allLov = Lov::where('lov_category', $request->lovCategory)->get();
            } else if ($request->code != null) {
                $allLov = Lov::where('lov_code', $request->code)->get();
            } else {
                $allLov = Lov::all();
            }
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            $allLov = [];
        }

        return view('lovs.index', $allLov);
    }

    public function getLovById(Request $request) {
        try {
            $lov = Lov::find($request->id);
            return ['status' => 'Success', 'lov' => $lov];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            return ['status' => 'Error', 'message' => $e->getMessage()];
        }
    }

    public function getLovCategoryList(Request $request) {
        try {
            $lovCategoryList = DB::table(DBConstant::LOV)
                ->select('lov_category')
                ->groupBy('lov_category')
                ->get();
            return ['status' => 'Success', 'lovCtgryList' => $lovCategoryList];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            return ['status' => 'Error', 'message' => $e->getMessage()];
        }
    }

    public function getDefaultLovByCodeCategory(Request $request){
        try {
            $lov = Lov::where('lov_category', $request->lov_category)->where('is_default', 'Y')->first();
            return ['status' => 'Success', 'lov' => $lov];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            return ['status' => 'Error', 'message' => $e->getMessage(), 'lov' => []];
        }
    }

}

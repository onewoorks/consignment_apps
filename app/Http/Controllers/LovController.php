<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Lov;
use Illuminate\Http\Request;
use App\Constants\DBConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\LovService as LovSvc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class LovController extends BaseController
{

    use LovSvc;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $lov = new Lov();
        $lov->lov_category = $request->lovCategory;
        $lov->lov_code = $request->lovCode;
        $lov->lov_name = $request->lovName;
        $lov->description = $request->lovDescription;
        $lov->is_required = $request->isRequired;
        $lov->is_default = $request->isDefault;
        $lov->created_at = Carbon::now();
        $lov->created_by = Auth::user()->name;
        $lov->save();

        return redirect('web/lov')->with('response', json_encode($lov));
    }

    public function update(Request $request)
    {
        $lov = Lov::findOrFail($request->id);
        $lov->lov_category = $request->lovCategory;
        $lov->lov_code = $request->lovCode;
        $lov->lov_name = $request->lovName;
        $lov->description = $request->lovDescription;
        $lov->is_required = $request->isRequired;
        $lov->is_default = $request->isDefault;
        $lov->updated_by = Auth::user()->name;
        $lov->updated_at = Carbon::now();
        $lov->save();

        return redirect('web/lov')->with('response', json_encode($lov));
    }

    public function delete(Request $request)
    {
        $lov = Lov::find($request->lovid);
        $lov->delete();

        return redirect('web/lov')->with('response', json_encode($lov));
    }

    public function getLovs(Request $request)
    {
        if ($request->lovCategory != null && $request->code != null) {
            $allLov = Lov::where('lov_category', $request->lovCategory)->where('lov_code', $request->code)->get();
        } else if ($request->lovCategory != null) {
            $allLov = Lov::where('lov_category', $request->lovCategory)->get();
        } else if ($request->code != null) {
            $allLov = Lov::where('lov_code', $request->code)->get();
        } else {
            $allLov = Lov::all();
        }

        $ctgrys = LovSvc::getLovCategoryList();
        $yesnolov = LovSvc::getLovByCodeCategory('YESNO');

        return view('web.lovs.index', ['lovs' => $allLov, 'categories' => $ctgrys, 'yesnolov' => $yesnolov]);
    }

    public function getLovById(Request $request)
    {
        try {
            $lov = Lov::find($request->id);
            return ['status' => 'Success', 'lov' => $lov];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            return ['status' => 'Error', 'message' => $e->getMessage()];
        }
    }

    public function getDefaultLovByCodeCategory(Request $request)
    {
        try {
            $lov = Lov::where('lov_category', $request->lov_category)->where('is_default', 'Y')->first();
            return ['status' => 'Success', 'lov' => $lov];
        } catch (Exception $e) {
            Log::error('' . $e->getMessage());
            return ['status' => 'Error', 'message' => $e->getMessage(), 'lov' => []];
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\LovService as Lov;

class BranchController extends BaseController
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
        $states = Lov::getLovByCodeCategory('STATE_CD');
        $branches = Branch::all();
        if ($branches) {
            foreach ($branches as $b) {
                $b->state_name = Lov::getLovNameByCdCtgryAndCode('STATE_CD', $b->state_code);
            }
        }

        return view('web.branch.index', ['branches' => $branches, 'states' => $states]);
    }

    public function show($id)
    {
        return Branch::findOrFail($id);
    }

    public function create(Request $request)
    {
        $response = Branch::create($request->all());
        return redirect('web/branch')->with('response', json_encode($response));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return redirect('web/branch')->with('response', json_encode($branch));
    }

    public function delete(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect('web/branch')->with('response', json_encode($branch));
    }
}

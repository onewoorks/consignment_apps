<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BranchController extends BaseController
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
        return view('web.branch.index', ['branches' => Branch::all()]);
    }

    public function show($id)
    {
        return Branch::findOrFail($id);
    }

    public function create(Request $request)
    {
        return Branch::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return $branch;
    }

    public function delete(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return 204;
    }
}

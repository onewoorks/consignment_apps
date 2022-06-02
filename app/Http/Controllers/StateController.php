<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
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
        return view('web.state.index', ['states' => State::all()]);
    }

    public function create(Request $request)
    {
        return State::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $branch = State::findOrFail($id);
        $branch->update($request->all());

        return $branch;
    }

    public function delete(Request $request, $id)
    {
        $branch = State::findOrFail($id);
        $branch->delete();

        return 204;
    }
}

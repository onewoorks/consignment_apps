<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
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
        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at', 'role', 'dob', 'avatar')->get();
        return view('web.user.index', ['users' => $users]);
    }

    public function viewProfile($id)
    {
        $user = Auth::user();
        if ($id != null && $id != '') {
            $user = User::findOrFail($id);
        }

        return view('web.user.profile', ['user' => $user]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect('/web/user');
    }
}

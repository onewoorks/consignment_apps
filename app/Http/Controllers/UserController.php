<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\LovService as Lov;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
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
        $roles = Lov::getLovByCodeCategory('USER_ROLE');

        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at', 'role', 'dob', 'avatar')->get();
        return view('web.user.index', ['users' => $users, 'user_roles' => json_decode(json_encode($roles))]);
    }

    public function viewProfile($id)
    {
        $user = Auth::user();
        if ($id != null && $id != '') {
            $user = User::findOrFail($id);
        }

        return view('web.user.profile', ['user' => $user]);
    }

    public function create(Request $data)
    {
        if (request()->has('avatar')) {
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }

        $response = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'role' => $data['role'],
            'dob' => date('Y-m-d', strtotime($data->dob)),
            'avatar' => "/images/" . $avatarName,
        ]);

        return redirect('web/user')->with('response', json_encode($response));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update($request->all());
        return redirect('web/user')->with('response', json_encode($user));
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->uid);
        $user->delete();
        return redirect('web/user')->with('response', json_encode($user));
    }
}

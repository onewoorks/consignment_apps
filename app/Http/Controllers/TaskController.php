<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Customer;
use App\Models\TaskUser;
use App\Models\Inventory;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\TaskAssignment;
use Illuminate\Support\Facades\Log;
use App\Traits\LovService as LovSvc;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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

    public function index()
    {
        $team = Team::leftJoin('kh_team_members', function ($join) {
            $join->on('kh_teams.id', '=', 'kh_team_members.team_id');
        })
            ->where('kh_team_members.user_id', Auth::user()->name)
            ->first();

        $task_status = LovSvc::getLovByCodeCategory('TASK_STATUS');

        $tasks = Task::where('created_by', Auth::user()->name)->get();

        return view('mob.task.index', ['team' => $team, 'members' => TeamMember::where('team_id', $team->team_id)->get(), 'task_status' => $task_status, 'tasks' => $tasks]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->name;
        $task = Task::create($data);

        if (isset($request->members) && is_array($request->members)) {
            foreach ($request->members as $user) {
                $taskUser = new TaskUser();
                $taskUser->task_id = $task->id;
                $taskUser->user_id = $user;
                $taskUser->remarks = '';
                $taskUser->created_by = Auth::user()->name;
                $taskUser->save();
            }
        }

        $users = TaskUser::where('task_id', $task->id)->get();
        $task->users = $this->getTaskUserDetails($users);;

        $customers = Customer::all();
        $task_status = LovSvc::getLovByCodeCategory('TASK_STATUS');
        $routes = TaskAssignment::where('task_id', $task->id)->get();

        if ($routes != null && count($routes) > 0) {
            foreach ($routes as $route) {
                $route->customer = Customer::findOrFail($route->shop_id);
            }
        }

        return view('mob.task.addroute', [
            'task' => $task,
            'all_routes' => $routes,
            'customers' => $customers,
            'task_status' => $task_status
        ]);
    }

    public function list($user)
    {
        return view('mob.task.list', ['tasks' => Task::leftJoin('kh_task_users', function ($join) {
            $join->on('kh_tasks.id', '=', 'kh_task_users.task_id');
        })
            ->where('kh_task_users.user_id', $user)
            ->get()]);
    }

    private function getTaskUserDetails($taskusers)
    {
        if (count($taskusers) > 0) {
            foreach ($taskusers as $user) {
                $u = User::where('name', $user->user_id)->first();
                $user->user_name = $u->name;
                $user->role = $u->role;
                $user->avatar = $u->avatar;
            }
        }

        return $taskusers;
    }

    public function updateTaskDetails($taskid)
    {
        try {
            $task = Task::findOrFail($taskid);
            $users = TaskUser::where('task_id', $taskid)->get();
            $task->users = $this->getTaskUserDetails($users);

            $routes = TaskAssignment::where('task_id', $taskid)->get();
            $customers = Customer::all();
            $task_status = LovSvc::getLovByCodeCategory('TASK_STATUS');

            if ($routes != null && count($routes) > 0) {
                foreach ($routes as $route) {
                    $route->customer = Customer::findOrFail($route->shop_id);
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 30);
        }

        return view('mob.task.addroute', [
            'task' => $task,
            'all_routes' => $routes,
            'customers' => $customers,
            'task_status' => $task_status
        ]);
    }

    public function details($id)
    {
        $task = Task::findOrFail($id);
        if ($task != null) {
            $users = TaskUser::where('task_id', $id)->get();
            $routes = TaskAssignment::where('task_id', $id)->get();

            $task->users = $this->getTaskUserDetails($users);
            if ($routes != null && count($routes) > 0) {
                foreach ($routes as $route) {
                    $route->customer = Customer::findOrFail($route->shop_id);
                }
            }
            $task->routes = $routes;
            $task_status = LovSvc::getLovByCodeCategory('TASK_STATUS');
            $shop_status = LovSvc::getLovByCodeCategory('SHOP_STATUS');
        }
        return view('mob.task.details', ['task' => $task, 'task_status' => $task_status, 'shop_status' => $shop_status]);
    }

    public function addRoute(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->name;
        $data['status'] = $request->task_status;
        TaskAssignment::create($data);

        $routes = TaskAssignment::where('task_id', $request->task_id)->get();
        if ($routes != null && count($routes) > 1) {
            foreach ($routes as $route) {
                $route->customer = Customer::findOrFail($route->shop_id);
            }
        }

        $task = Task::findOrFail($request->task_id);
        $users = TaskUser::where('task_id', $request->task_id)->get();
        $task->users = $this->getTaskUserDetails($users);

        $customers = Customer::all();
        $task_status = LovSvc::getLovByCodeCategory('TASK_STATUS');

        return view('mob.task.addroute', [
            'task' => $task, 'all_routes' => $routes, 'customers' => $customers,
            'task_status' => $task_status
        ]);
    }

    public function deleteRoute($routeid)
    {
        $route = TaskAssignment::findOrFail($routeid);
        $route->delete();

        return redirect('/mob/task/edit/' . $route->task_id);
    }

    public function updateRoute($routeid, Request $request)
    {
        $route = TaskAssignment::findOrFail($routeid);
        $route->shop_status = $request->shop_status;
        $route->status = $request->task_status;

        $fileName = $request->shop_name;
        $destinationPath = '/uploads/customer/';
        $shop_img_path =  $destinationPath . $fileName;

        $route->shop_image = $shop_img_path;
        $route->updated_by = Auth::user()->name;
        $route->save();

        if ($request->shop_status === 'C') {
            $customer = Customer::findOrFail($route->shop_id);
            $inventory = new Inventory();
            $inventory->shop_id = $route->shop_id;
            $inventory->region = $customer->region;
            $inventory->product_code = 'SHOP_CLOSED';
            $inventory->created_by = Auth::user()->name;
            $inventory->save();
        }

        return redirect('/mob/task/details/' . $route->task_id);
    }

    public function upload(Request $request)
    {
        try {
            $file = $request->file;
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/uploads/customer/';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777);
            }
            $file->move($destinationPath, $fileName);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public function delete_uploaded_img(Request $request)
    {
        $filename =  $request->get('filename');
        Customer::where('shop_image', $filename)->delete();
        $path = public_path('uploads/customer/') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
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
        $default_datetime = Carbon::now()->format('Y-m-d H:i');

        return view('mob.task.index', [
            'team' => $team, 'members' => TeamMember::where(
                'team_id',
                $team->team_id
            )->get(), 'task_status' => $task_status,
            'tasks' => $tasks, 'default_datetime' => $default_datetime
        ]);
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

        return redirect('/mob/task/edit/' . $task->id);
    }

    public function deleteTask($taskid)
    {
        $task = Task::findOrFail($taskid);

        if ($task->task_status === 'N') {
            $routes = TaskAssignment::where('task_id', $taskid)->get();
            if ($routes != null && count($routes) > 0) {
                foreach ($routes as $route) {
                    $route->delete();
                }
            }

            $assignees = TaskUser::where('task_id', $taskid)->get();
            if ($assignees != null && count($assignees) > 0) {
                foreach ($assignees as $assignee) {
                    $assignee->delete();
                }
            }


            $task->delete();
        }

        return redirect('/mob/task');
    }

    public function list($user)
    {
        $tasks = Task::leftJoin('kh_task_users', function ($join) {
            $join->on('kh_tasks.id', '=', 'kh_task_users.task_id');
        })
            ->where('kh_task_users.user_id', $user)
            ->get();

        if(count($tasks) > 0){
            foreach ($tasks as $task) {
                $task->status_name = LovSvc::getLovNameByCdCtgryAndCode('TASK_STATUS', $task->task_status);
            }
        }
        return view('mob.task.list', ['tasks' => $tasks]);
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
                    $route->status_name = LovSvc::getLovNameByCdCtgryAndCode('TASK_STATUS', $route->status);
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 30);
        }

        $default_datetime = Carbon::now()->format('Y-m-d H:i');

        $current_task_seq = TaskAssignment::where('task_id', $taskid)->max('sequence');

        return view('mob.task.addroute', [
            'task' => $task,
            'all_routes' => $routes,
            'customers' => $customers,
            'task_status' => $task_status,
            'default_datetime' => $default_datetime,
            'task_seq' => $current_task_seq + 1
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
                    $route->status_name = LovSvc::getLovNameByCdCtgryAndCode('TASK_STATUS', $route->status);
                    $route->shop_sts_name = LovSvc::getLovNameByCdCtgryAndCode('SHOP_STATUS', $route->shop_status);
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

        return redirect('/mob/task/edit/' . $data['task_id']);
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

        $customer = Customer::findOrFail($route->shop_id);
        $customer->updated_by = Auth::user()->name;
        $customer->last_visit = Carbon::now();
        $customer->save();

        if ($request->shop_status === 'C') {
            $inventory = new Inventory();
            $inventory->shop_id = $route->shop_id;
            $inventory->region = $customer->region;
            $inventory->product_code = 'SHOP_CLOSED';
            $inventory->created_by = Auth::user()->name;
            $inventory->save();
        }

        return redirect('/mob/task/details/' . $route->task_id);
    }

    public function upload($routeid, Request $request)
    {
        try {
            $file = $request->file('shopimgfile');
            $fileName = $file->getClientOriginalName();
            $shop_path = '/uploads/customer/';
            $destinationPath = public_path() . $shop_path;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777);
            }
            $file->move($destinationPath, $fileName);

            $taskassign = TaskAssignment::findOrFail($routeid);
            $taskassign->shop_image = $shop_path . $fileName;
            $taskassign->updated_by = Auth::user()->name;
            $taskassign->save();
        } catch (Exception $e) {
            Log::error($e);
        }

        return redirect('/mob/task/details/' . $request->task_id);
    }

    public function delete_uploaded_img($routeid, Request $request)
    {
        $taskassign = TaskAssignment::findOrFail($routeid);
        $path = public_path() . $taskassign->shop_image;
        if (file_exists($path)) {
            unlink($path);
        }

        $taskassign->shop_image = null;
        $taskassign->updated_by = Auth::user()->name;
        $taskassign->save();

        return redirect('/mob/task/details/' . $request->task_id);
    }
}

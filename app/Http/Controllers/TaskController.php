<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use App\Models\Team;
use App\Models\Customer;
use App\Models\TaskUser;
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

        return view('mob.task.index', ['team' => $team, 'members' => TeamMember::where('team_id', $team->team_id)->get(), 'task_status' => $task_status]);
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
        $task->users = $users;

        $customers = Customer::all();
        $task_status = LovSvc::getLovByCodeCategory('TASK_STATUS');
        $routes = TaskAssignment::where('task_id', $task->id)->get();

        if ($routes != null && count($routes) > 1) {
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

    public function details($id)
    {
        $task = Task::findOrFail($id);
        if ($task != null) {
            $users = TaskUser::where('task_id', $id)->get();
            $routes = TaskAssignment::where('task_id', $id)->get();

            $task->users = $users;

            if ($routes != null && count($routes) > 1) {
                foreach ($routes as $route) {
                    $route->customer = Customer::findOrFail($route->shop_id);
                }
            }

            $task->routes = $routes;
        }
        return view('mob.task.details', ['task' => $task]);
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
        $task->users = $users;

        return view('mob.task.addroute', ['task' => $task, 'all_routes' => $routes]);
    }

    public function updateRoute(Request $request)
    {
        $route = TaskAssignment::findOrFail($request->id);
        $route->update($request->all());

        return view('mob.task.addroute', ['route' => $route, 'all_routes' => TaskAssignment::where('task_id', $route->task_id)->get()]);
    }

    public function deleteRoute($id)
    {
        $route = TaskAssignment::findOrFail($id);
        $route->delete();

        return view('mob.task.addroute', ['route' => $route, 'all_routes' => TaskAssignment::where('task_id', $route->task_id)->get()]);
    }
}

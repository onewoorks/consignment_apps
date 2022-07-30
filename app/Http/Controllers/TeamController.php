<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Traits\LovService as Lov;
use Illuminate\Routing\Controller as BaseController;

class TeamController extends BaseController
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
        $team_roles = Lov::getLovByCodeCategory('TEAM_ROLE');
        $teams = Team::all();

        return view('web.team.index', ['teams' => $teams, 'team_roles' => $team_roles]);
    }

    public function show($id)
    {
        return Team::findOrFail($id);
    }

    public function create(Request $request)
    {
        $response = Team::create($request->all());
        return redirect('web/team')->with('response', json_encode($response));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->update($request->all());

        return redirect('web/team')->with('response', json_encode($team));
    }

    public function delete(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect('web/team')->with('response', json_encode($team));
    }

    public function indexMember($team_id)
    {
        $member_roles = Lov::getLovByCodeCategory('MEMBER_ROLE');
        $team_members = TeamMember::where('team_id', $team_id)->get();
        $users = $this->getUsers();
        $team = Team::findOrFail($team_id);

        return view('web.team.member.index', ['members' => $team_members, 'member_roles' => $member_roles, 'team' => $team, 'users' => $users]);
    }

    public function addMember(Request $request)
    {
        $response = TeamMember::create($request->all());
        return redirect('web/team/member/' . $request->team_id)->with('response', json_encode($response));
    }

    public function updateMember(Request $request)
    {
        $teammember = TeamMember::findOrFail($request->id);
        $teammember->update($request->all());

        return redirect('web/team/member/' . $request->team_id)->with('response', json_encode($teammember));
    }

    public function deleteMember(Request $request)
    {
        $teammember = TeamMember::findOrFail($request->uid);
        $teammember->delete();

        return redirect('web/team/member/' . $request->team_id)->with('response', json_encode($teammember));
    }

    private function getUsers()
    {
        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at', 'role', 'dob', 'avatar')->get();

        return $users;
    }
}

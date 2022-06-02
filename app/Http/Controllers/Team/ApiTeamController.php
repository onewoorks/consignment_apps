<?php

namespace App\Http\Controllers\Team;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ApiTeamController extends Controller {

    public function listByTeamId(Request $request)
    {
        $data = $request->all();
        return TeamMember::where('team_id', $data['id'])->where('role', '<>', 'L')->get();
    }

}

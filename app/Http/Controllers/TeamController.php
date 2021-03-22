<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamFormRequest;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private $teamService;

    public function __construct(TeamService $teamService) {
        $this->teamService = $teamService;
    }

    public function index(Request $request)
    {
        return response()->json($this->teamService->loadAll($request));
    }

    public function show(int $id)
    {
        return response()->json($this->teamService->find($id));
    }

    public function store(TeamFormRequest $request)
    {
        return response()->json($this->teamService->save($request), 201);
    }

    public function update(TeamFormRequest $request, Team $team)
    {
        return response()->json($this->teamService->save($request, $team));
    }

}

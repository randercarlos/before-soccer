<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalFormRequest;
use App\Models\Goal;
use App\Services\GoalService;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    private $goalService;

    public function __construct(GoalService $goalService) {
        $this->goalService = $goalService;
    }

    public function index(Request $request)
    {
        return response()->json($this->goalService->loadAll($request));
    }

    public function show(int $id)
    {
        return response()->json($this->goalService->find($id));
    }

    public function store(GoalFormRequest $request)
    {
        return response()->json($this->goalService->save($request), 201);
    }

    public function update(GoalFormRequest $request, Goal $goal)
    {
        return response()->json($this->goalService->save($request, $goal));
    }

}

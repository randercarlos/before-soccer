<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerFormRequest;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    private $playerService;

    public function __construct(PlayerService $playerService) {
        $this->playerService = $playerService;
    }

    public function index(Request $request)
    {
        return response()->json($this->playerService->loadAll($request));
    }

    public function show(int $id)
    {
        return response()->json($this->playerService->find($id));
    }

    public function store(PlayerFormRequest $request)
    {
        return response()->json($this->playerService->save($request), 201);
    }

    public function update(PlayerFormRequest $request, Player $player)
    {
        return response()->json($this->playerService->save($request, $player));
    }
}

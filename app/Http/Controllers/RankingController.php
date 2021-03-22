<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamFormRequest;
use App\Models\Team;
use App\Services\RankingService;
use App\Services\TeamService;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    private $rankingService;

    public function __construct(RankingService $rankingService) {
        $this->rankingService = $rankingService;
    }


    public function players()
    {
        return response()->json($this->rankingService->players());
    }

    public function teams()
    {
        return response()->json($this->rankingService->teams());
    }

}

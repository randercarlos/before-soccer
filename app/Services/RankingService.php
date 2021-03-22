<?php

namespace App\Services;

use App\Models\Match;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RankingService
{
    public function players() {
        $ranking = Player::has('goals')->withCount('goals')->with('team')->orderByDesc('goals_count')
            ->get()
            ->map(function($player) {
                static $position = 1;

                $new_player = new \stdClass();
                $new_player->position = $position++;
                $new_player->name = $player->name;
                $new_player->team = $player->team->name;
                $new_player->goals = $player->goals_count;

                return $new_player;
            });

        return $ranking;
    }


    public function teams() {
        $ranking = Team::withCount('goals', 'yellowCards', 'redCards')->orderByDesc('goals_count')
            ->get()
            ->map(function($team) {

                $ranking = new \stdClass();
                $matchesFromTeam = Match::where('home_team_id', $team->id)->orWhere('visitor_team_id', $team->id)->get();

                $ranking->name = $team->name;
                $ranking->matches = $matchesFromTeam->count();
                $ranking->wins = $matchesFromTeam->where('home_team_score', 'W')->where('home_team_id', $team->id)->count()
                    + $matchesFromTeam->where('visitor_team_score', 'W')->where('visitor_team_id', $team->id)->count();

                $ranking->loses = $matchesFromTeam->where('home_team_score', 'L')->where('home_team_id', $team->id)->count()
                    + $matchesFromTeam->where('visitor_team_score', 'L')->where('visitor_team_id', $team->id)->count();

                $ranking->ties = $matchesFromTeam->where('home_team_score', 'T')->where('home_team_id', $team->id)->count()
                    + $matchesFromTeam->where('visitor_team_score', 'T')->where('visitor_team_id', $team->id)->count();

                $ranking->yellow_cards = $team->yellow_cards_count;
                $ranking->red_cards = $team->red_cards_count;
//                $ranking->partial_score = ($ranking->wins * 3) + ($ranking->ties * 1);  // without minus yellow and red cards
//                $ranking->score = $ranking->partial_score - ($ranking->yellow_cards * 1) - ($ranking->red_cards * 2);
                $ranking->score = ($ranking->wins * 3) + ($ranking->ties * 1);
                $ranking->goals = $team->goals_count;

                return $ranking;
            })
            ->sortByDesc('score')
            ->map(function($ranking) {
                static $position = 1;
                $ranking->position = $position++;

                return $ranking;
            })
            ->values();

        return $ranking;
    }
}

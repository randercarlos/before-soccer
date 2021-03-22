<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CardService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Card();
    }

    public function loadAll() {

        $query = Card::with(['player', 'team', 'match'])->newQuery();
        $query = $this->buildFilters($query, request());

        return $query->get();
    }

    public function find(int $id): Model
    {
        if (!$team = Card::with(['player', 'team', 'match'])->find($id)) {
            throw new ModelNotFoundException("Card with id $id doesn't exists!");
        }

        return $team;
    }

    private function buildFilters(Builder $query, Request $request): Builder {

        $query->when($request->query('match_id'), function ($q) use ($request) {
            return $q->where('match_id', $request->query('match_id'));
        });

        $query->when($request->query('team_id'), function ($q) use ($request) {
            return $q->where('team_id', $request->query('team_id'));
        });

        $query->when($request->query('player_id'), function ($q) use ($request) {
            return $q->where('player_id', $request->query('player_id'));
        });

        $query->when($request->filled('sort'),
            function ($q) use ($request) {
                return $q->orderBy($request->query('sort'),
                    $request->query('order', 'asc') === 'asc' ? 'asc' : 'desc');
            });

        return $query;
    }
}

<?php

namespace App\Services;

use App\Models\Match;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TeamService extends AbstractService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Team();
    }

    public function loadAll()
    {
        $query = Team::with('players')->newQuery();
        $query = $this->buildFilters($query, request());

        return $query->get();
    }

    public function find(int $id): Model
    {
        if (!$team = Team::with('players')->find($id)) {
            throw new ModelNotFoundException("Player with id $id doesn't exists!");
        }

        return $team;
    }

    private function buildFilters(Builder $query, Request $request): Builder
    {

        $query->when($request->query('name'), function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->query('name') . '%');
        });

        $query->when($request->filled('sort'),
            function ($q) use ($request) {
                return $q->orderBy($request->query('sort'),
                    $request->query('order', 'asc') === 'asc' ? 'asc' : 'desc');
            });

        return $query;
    }
}

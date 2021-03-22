<?php

namespace App\Services;

use App\Models\Player;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function React\Promise\map;

class PlayerService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new Player();
    }

    public function loadAll() {

        $query = Player::with('team')->newQuery();
        $query = $this->buildFilters($query, request());

        return $query->get();
    }

    public function find(int $id): Model {
        if (!$player = Player::with('team')->find($id)) {
            throw new ModelNotFoundException("Player with id $id doesn't exists!" );
        }

        return $player;
    }

    private function buildFilters(Builder $query, Request $request): Builder {

        $query->when($request->query('name'), function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->query('name') . '%');
        });

        $query->when($request->query('cpf'), function ($q) use ($request) {
            return $q->where('cpf', $request->query('cpf'));
        });

        $query->when($request->query('shirt_number'), function ($q) use ($request) {
            return $q->where('shirt_number', $request->query('shirt_number'));
        });

        $query->when($request->query('team_id'), function ($q) use ($request) {
            return $q->where('team_id', $request->query('team_id'));
        });

        $query->when($request->filled('sort'),
            function ($q) use ($request) {
                return $q->orderBy($request->query('sort'),
                    $request->query('order', 'asc') === 'asc' ? 'asc' : 'desc');
            });

        return $query;
    }
}

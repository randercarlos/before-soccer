<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'goals';
    protected $fillable = ['match_id', 'team_id', 'player_id'];

    public function match() {
        return $this->belongsTo(Match::class);
    }

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function player() {
        return $this->belongsTo(Player::class);
    }
}

<?php

namespace App\Models;

use App\Enums\CardTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'cards';
    protected $fillable = ['type', 'match_id', 'team_id', 'player_id'];

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'teams';
    protected $fillable = ['name'];

    public function players() {
        return $this->hasMany(Player::class)->orderBy('id');
    }

    public function goals() {
        return $this->hasMany(Goal::class)->orderBy('id');
    }

    public function cards() {
        return $this->hasMany(Card::class)->orderBy('id');
    }

    public function yellowCards() {
        return $this->hasMany(Card::class)->whereType('Y')->orderBy('id');
    }

    public function redCards() {
        return $this->hasMany(Card::class)->whereType('R')->orderBy('id');
    }
}

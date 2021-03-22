<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    const RECORDS_PER_PAGE = 10;
    protected $table = 'players';
    protected $fillable = ['name', 'cpf', 'shirt_number', 'team_id'];


    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function goals() {
        return $this->hasMany(Goal::class);
    }

    public function getCpfAttribute($cpf) {
        $block_1 = substr($cpf,0,3);
        $block_2 = substr($cpf,3,3);
        $block_3 = substr($cpf,6,3);
        $block_4 = substr($cpf,-2);

        return "{$block_1}.{$block_2}.{$block_3}-{$block_4}";
    }

    public function setCpfAttribute($cpf) {
        $this->attributes['cpf'] = str_replace('.', '', str_replace('-', '', $cpf));
    }
}

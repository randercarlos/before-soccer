<?php

use App\Models\Goal;
use Faker\Generator as Faker;

$factory->define(Goal::class, function (Faker $faker) {

    return [
        'match_id' => null,
        'team_id' => null,
        'player_id' => $faker->numberBetween(1, 50),
    ];
});

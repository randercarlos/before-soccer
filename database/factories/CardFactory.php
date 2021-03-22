<?php

use App\Models\Card;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {

    return [
        'type' => $faker->randomElement(['Y', 'R']),
        'match_id' => null,
        'team_id' => null,
        'player_id' => $faker->numberBetween(1, 50),
    ];
});

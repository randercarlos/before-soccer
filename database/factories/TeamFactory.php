<?php

use App\Models\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['Vasco', 'Flamengo', 'Botafogo', 'Fluminense', 'São Paulo',
            'Corinthians', 'Palmeiras', 'Santos', 'Atlético-MG', 'Curitiba']),
    ];
});

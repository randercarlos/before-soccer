<?php

use App\Models\Player;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    static $number = 1;

    return [
        'name' => $faker->firstNameMale . ' ' . $faker->lastName,
        'cpf' => $faker->cpf(false),
        'shirt_number' => $number++ > 4 ? $number = 1 : $number,
        'team_id' => $faker->numberBetween(1, 10)
    ];
});

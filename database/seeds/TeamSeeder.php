<?php

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Player;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Team::class, 10)->create()->each(function($team) {
            $team->players()->createMany(
                factory(Player::class, 5)->make()->toArray()
            );
        });
    }
}

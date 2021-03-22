<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Player::class, 10)->create();
    }
}

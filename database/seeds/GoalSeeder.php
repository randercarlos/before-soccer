<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Goal::class, 10)->create();
    }
}

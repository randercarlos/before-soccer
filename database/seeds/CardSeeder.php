<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Card::class, 10)->create();
    }
}

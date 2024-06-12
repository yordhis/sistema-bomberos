<?php

namespace Database\Seeders;

use App\Models\Bombero;
use Illuminate\Database\Seeder;

class BomberoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bomberos = Bombero::factory()->count(3)->make();
    }
}

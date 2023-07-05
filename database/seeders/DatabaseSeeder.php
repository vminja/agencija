<?php

namespace Database\Seeders;

use App\Models\Knjiga;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Animal::factory(10)->create();
        // \App\Models\Autor::factory(5)->create();
        Knjiga::factory(5)->create();
    }
}

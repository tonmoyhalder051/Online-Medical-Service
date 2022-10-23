<?php

namespace Database\Seeders;

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
       \App\Models\User::factory(100)->create();
        \App\Models\profile::factory(100)->create();
        \App\Models\test::factory(50)->create();
    }
}

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
         \App\Models\User::factory(10)->create();
         \App\Models\Ticket::factory(20)->create();
         \App\Models\Orders::factory(1)->create();
         \App\Models\Payment::factory(1)->create();
    }
}

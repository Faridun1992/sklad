<?php

namespace Database\Seeders;

use App\Models\Acceptance;
use Illuminate\Database\Seeder;

class AcceptanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Acceptance::factory(50)->create();
    }
}

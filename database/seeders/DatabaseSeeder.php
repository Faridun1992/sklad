<?php

namespace Database\Seeders;

use App\Models\Unit;
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
        $this->call([
            RoleSeeder::class,
            WorkerSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
            StorageSeeder::class,
            ProductSeeder::class,
            AcceptanceSeeder::class
        ]);
    }
}

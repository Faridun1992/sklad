<?php

namespace Database\Seeders;

use App\Models\Storage;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storages = [
            [
                'title' => 'основной склад',
                'address' => 'г. Уральск',
                'status' => true
            ]
        ];

        Storage::insert($storages);
    }
}

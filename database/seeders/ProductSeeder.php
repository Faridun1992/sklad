<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Storage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storages = Storage::all();
        Product::factory(100)->create()->each(fn($product)=>$product->storages()->attach($storages->random(rand(1, 2))));
    }
}

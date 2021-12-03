<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Storage;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'title' => 'шт',
                'full_title' => 'штук',
                'code' => random_int(1, 100),
            ],
            [
                'title' => 'л',
                'full_title' => 'литр',
                'code' => random_int(1, 100),
            ],
            [
                'title' => 'м',
                'full_title' => 'метр',
                'code' => random_int(1, 100),
            ],
            [
                'title' => 'кг',
                'full_title' => 'килограмм',
                'code' => random_int(1, 100),
            ],
            [
                'title' => 'т',
                'full_title' => 'тонн',
                'code' => random_int(1, 100),
            ],

        ];

        Unit::insert($units);
    }
}

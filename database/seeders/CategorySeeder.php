<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Категория 1',
            ],
            [
                'title' => 'Категория 2',
            ],
            [
                'title' => 'Категория 3',
            ],
            [
                'title' => 'Категория 4',
            ],
            [
                'title' => 'Категория 5'
            ]

        ];

        Category::insert($categories);
    }
}

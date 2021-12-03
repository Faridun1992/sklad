<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'title' => 'Стажер',
            ],
            [
                'title' => 'Сотрудник',
            ],
            [
                'title' => 'Старший сотрудник',
            ],
            [
                'title' => 'Модератор',
            ],
            [
                'title' => 'администратор'
            ]

        ];

        Role::insert($roles);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /*app() [\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();*/
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Администратор']);
        Role::create(['name' => 'Модератор']);
        Role::create(['name' => 'Старший сотрудник']);
        Role::create(['name' => 'Сотрудник']);
        Role::create(['name' => 'Стажер']);
    }
}

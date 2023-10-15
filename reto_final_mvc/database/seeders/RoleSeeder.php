<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name'=> 'admin']);
        $estudiante =Role::create(['name'=> 'estudiante']);

        Permission::create(['name' => 'index']) ->syncRoles([$admin,$estudiante]);
        Permission::create(['name' => 'store'])->syncRoles([$admin]);
        Permission::create(['name' => 'show'])->syncRoles([$admin,$estudiante]);
        Permission::create(['name' => 'update'])->syncRoles([$admin]);
        Permission::create(['name' => 'destroy'])->syncRoles([$admin]);
        


    }
}

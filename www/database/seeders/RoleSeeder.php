<?php

namespace Database\Seeders;

use App\Constant\RoleConst;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = array_column(RoleConst::cases(), 'value');

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Constant\RoleConst;
use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua nama role dari RoleConst
        $roles = array_column(RoleConst::cases(), 'value');

        // Ambil semua role yang sesuai dengan nama dari RoleConst menggunakan whereIn
        $roleModels = Role::whereIn('name', $roles)->pluck('id', 'name')->toArray();

        // Cek apakah role ditemukan
        if (empty($roleModels)) {
            $this->command->error('No roles found matching the RoleConst values.');
            return;
        }

        // Proses setiap role
        foreach ($roleModels as $roleName => $roleId) {
            // Buat nama file permission berdasarkan role (misal: 'PermissionAdmin' untuk role 'Admin')
            $permissionClass = "App\\Constant\\Permission{$roleName}";

            // Jika file permission ada
            if (class_exists($permissionClass)) {
                // Ambil semua permission dari enum
                $permissions = $permissionClass::cases();

                // Ambil semua nama permission dari enum
                $permissionNames = array_column($permissions, 'value');

                // Ambil semua permissions dari database yang sesuai dengan nama permission menggunakan whereIn
                $permissionsMap = Permission::whereIn('name', $permissionNames)->pluck('id', 'name')->toArray();

                // Proses assignment jika permission ditemukan
                if (!empty($permissionsMap)) {
                    foreach ($permissions as $permissionEnum) {
                        $permissionName = $permissionEnum->value;

                        // Jika permission ditemukan, assign ke role
                        if (isset($permissionsMap[$permissionName])) {
                            Role::find($roleId)->givePermissionTo($permissionName);
                        } else {
                            $this->command->error("Permission '{$permissionName}' not found for role '{$roleName}'.");
                        }
                    }
                } else {
                    $this->command->error("No permissions found in the database for role '{$roleName}'.");
                }
            } else {
                $this->command->error("Permission class for role '{$roleName}' not found.");
            }
        }
    }
}

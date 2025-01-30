<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Informasikan kepada pengguna bahwa semua file akan dihapus
        $this->command->info('Menghapus semua file di storage...');

        // Path ke folder storage/app/private
        $privatePath = storage_path('app/private');

        // Hapus semua file dan folder di dalam folder "private"
        if (File::exists($privatePath)) {
            File::deleteDirectory($privatePath);
        }

        // Buat ulang folder "private"
        File::makeDirectory($privatePath, 0755, true);

        // Jalankan seeder lainnya
        $this->call([
            RoleSeeder::class, //ok
            PermissionSeeder::class, //ok
            RouteSeeder::class, //ok
            MenuSeeder::class, //ok
            MenuItemSeeder::class, //ok
            RoleHasPermissionSeeder::class, //ok
            UserSeeder::class, //ok
            IdentitasSeeder::class, //ok
        ]);
    }
}

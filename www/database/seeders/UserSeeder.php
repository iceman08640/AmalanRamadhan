<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // USER
        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'password' => Hash::make('password')
        ]);
        $user->assignRole('User');
    }
}

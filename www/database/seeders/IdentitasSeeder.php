<?php

namespace Database\Seeders;

use App\Constant\IdentitasConst;
use App\Models\Identitas;
use Illuminate\Database\Seeder;

class IdentitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Identitas::insert([
            'id' => IdentitasConst::ID,
            'aset_id' => null,
            'nama_sistem' => 'Amalan Ramadhan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

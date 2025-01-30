<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('masjid', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cap_aset_id')->nullable()->default(null);
            $table->uuid('ttd_aset_id')->nullable()->default(null);
            $table->string('nama');
            $table->string('takmir');
            $table->string('dukuh');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kab_kota');
            $table->string('kode_pos');
            $table->text('alamat');
            $table->string('cp_telp');
            $table->string('cp_nama');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('cap_aset_id')->references('id')->on('aset')->nullOnDelete();
            $table->foreign('ttd_aset_id')->references('id')->on('aset')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masjid');
    }
};

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
        Schema::create('identitas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('aset_id')->nullable()->default(null);
            $table->string('nama_sistem');
            $table->timestamps();

            // relasi foreign key ke aset
            $table->foreign('aset_id')->references('id')->on('aset')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas');
    }
};

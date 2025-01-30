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
        Schema::create('kultum', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('masjid_id');
            $table->uuid('agenda_id');
            $table->uuid('imam_ustadz_id')->nullable()->default(null);
            $table->uuid('kultum_ustadz_id')->nullable()->default(null);
            $table->uuid('kulsub_ustadz_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade');
            $table->foreign('masjid_id')->references('id')->on('masjid')->onDelete('cascade');
            $table->foreign('imam_ustadz_id')->references('id')->on('ustadz')->onDelete('cascade');
            $table->foreign('kultum_ustadz_id')->references('id')->on('ustadz')->onDelete('cascade');
            $table->foreign('kulsub_ustadz_id')->references('id')->on('ustadz')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kultum');
    }
};

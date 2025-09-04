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
        Schema::create('data_siswas_pkl', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->enum('gender', ['L', 'P']);
            $table->text('alamat');
            $table->string('kontak');
            $table->string('email');
            $table->string('foto')->nullable();
            $table->enum('status_lapor_pkl', ['Belum', 'Sudah'])->default('Belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswas_pkl');
    }
};

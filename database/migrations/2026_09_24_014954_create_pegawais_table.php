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
    Schema::create('pegawais', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->unsignedTinyInteger('umur');
        $table->string('tanggal_masuk'); // disimpan sebagai string, bukan date
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('pegawais');
}
};
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
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Misalnya: C1, C2, dst
            $table->string('name'); // Nama atau deskripsi, seperti "Nilai PAT"
            $table->unsignedTinyInteger('bobot'); // Misal 25.00 untuk 25%
            $table->enum('type', ['benefit', 'cost']); // Tipe bobot
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};

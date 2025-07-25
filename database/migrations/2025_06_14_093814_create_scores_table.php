<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('criteria_id')->constrained('criterias')->onDelete('cascade');
            $table->float('value'); // tetap untuk nilai akhir MOORA

            $table->timestamps();
            $table->unique(['student_id', 'criteria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};

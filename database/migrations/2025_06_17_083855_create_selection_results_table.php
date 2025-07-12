<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionResultsTable extends Migration
{
    public function up()
    {
        Schema::create('selection_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->float('yi');
            $table->string('cluster'); // contoh: 'High Score', 'Medium Score', 'Low Score'
            $table->json('weighted_scores')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('selection_results');
    }
}

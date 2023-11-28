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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('rating');
            $table->string('reviews');
            $table->string('image');
            $table->string('subtitle');
            $table->string('description');
            $table->string('features');
            $table->time('start_date');
            $table->time('end_date');
            $table->string('price');
            $table->string('learning_scheme');
            $table->string('why');
            $table->string('prerequisite');
            $table->string('best_fit');
            $table->string('program_flow');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

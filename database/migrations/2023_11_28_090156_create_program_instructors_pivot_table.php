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
        Schema::create('program_instructors_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programs_id')->index();
            $table->foreignId('program_instructors_id')->index();

            $table->timestamps();

            $table->foreign('programs_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('program_instructors_id')->references('id')->on('program_instructors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_instructors_pivot');
    }
};

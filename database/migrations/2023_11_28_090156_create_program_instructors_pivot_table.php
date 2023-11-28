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
            $table->string('programs_id')->index();
            $table->string('program_instructors_id')->index();
            $table->timestamps();

            $table->foreign('programs_id')->references('id')->on('programs');
            $table->foreign('program_instructors_id')->references('id')->on('program_instructors');

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

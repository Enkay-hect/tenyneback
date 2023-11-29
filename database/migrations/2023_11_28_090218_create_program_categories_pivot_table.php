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
        Schema::create('program_categories_pivot', function (Blueprint $table) {
            $table->id();
            $table->string('programs_id')->index();
            $table->string('program_categories_id')->index();

            $table->timestamps();

            $table->foreign('programs_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('program_categories_id')->references('id')->on('program_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_categories_pivot');
    }
};

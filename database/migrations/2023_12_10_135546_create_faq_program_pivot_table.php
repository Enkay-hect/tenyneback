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
        Schema::create('faq_program_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_id');
            $table->foreignId('program_id');
            $table->timestamps();

            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_program_pivot');
    }
};

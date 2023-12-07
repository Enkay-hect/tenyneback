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
        Schema::create('talentpipeline_services', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('contact');
            $table->string('email');
            $table->string('phone_number');
            $table->string('role'); 
            $table->text('description');
            $table->integer('number_of_hires');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location');
            $table->string('mode');
            $table->string('budget');
            $table->string('payment');
            $table->text('additional_requirement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talentpipeline_services');
    }
};

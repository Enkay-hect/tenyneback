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
        Schema::create('job_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_role_id')->index();
            $table->foreignId('job_category_id')->index();
            $table->timestamps();

            $table->foreign('job_role_id')->references('id')->on('job_roles');
            $table->foreign('job_category_id')->references('id')->on('job_role_categories');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_pivot');
    }
};

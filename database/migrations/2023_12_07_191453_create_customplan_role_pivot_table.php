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
        Schema::create('customplan_role_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->index();
            $table->foreignId('customplan_id')->index();

            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('job_roles')->onDelete('cascade');
            $table->foreign('customplan_id')->references('id')->on('custom_plan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customplan_role_pivot');
    }
};

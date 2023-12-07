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
        Schema::table('custom_plan', function (Blueprint $table) {
            Schema::rename('custom_plan', 'custom_plans');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_plan', function (Blueprint $table) {
            Schema::rename('custom_plans', 'custom_plan');

        });
    }
};

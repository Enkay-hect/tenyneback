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
        Schema::table('talentpipeline_services', function (Blueprint $table) {
            Schema::rename('talentpipeline_services', 'talentpipelines');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('talentpipeline_services', function (Blueprint $table) {
            Schema::rename('talentpipelines', 'talentpipeline_services');

        });
    }
};

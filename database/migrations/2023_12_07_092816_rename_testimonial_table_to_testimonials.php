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
        Schema::table('testimonial', function (Blueprint $table) {
            Schema::rename('testimonial', 'testimonials');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonial', function (Blueprint $table) {
            Schema::rename('testimonials', 'testimonial');

        });
    }
};

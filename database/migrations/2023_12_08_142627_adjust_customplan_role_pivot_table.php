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
        Schema::table('customplan_role_pivot', function (Blueprint $table) {
             $table->foreign('submission_id')->references('id')->on('custom_plans');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customplan_role_pivot', function (Blueprint $table) {
            //
        });
    }
};

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
            $table->foreignId('plan_id')->after('role_id');

            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

        });

        Schema::table('customplan_role_pivot', function (Blueprint $table) {
            $table->renameColumn('customplan_id', 'submission_id');
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

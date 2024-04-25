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
        Schema::table('fc007_logs', function (Blueprint $table) {
            $table->integer('status_id')->after('file_path')->default(1)->comment('1 - generate , 2 - for verification , 3 - for approval');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fc007_logs', function (Blueprint $table) {
            //
        });
    }
};

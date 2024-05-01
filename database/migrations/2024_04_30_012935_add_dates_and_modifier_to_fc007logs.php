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
            $table->text('generated_by')->default(NULL);
            $table->text('verified_by')->default(NULL);
            $table->dateTime('verified_at')->default(now());
            $table->text('approved_by')->default(NULL);
            $table->dateTime('approved_at')->default(now());
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

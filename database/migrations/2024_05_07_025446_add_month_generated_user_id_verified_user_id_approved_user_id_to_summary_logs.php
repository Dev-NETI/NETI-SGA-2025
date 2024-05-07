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
        Schema::table('summary_logs', function (Blueprint $table) {
            $table->text('month')->after('hash')->nullable();
            $table->unsignedBigInteger('generated_user_id')->after('generated_by')->nullable();
            $table->unsignedBigInteger('verified_user_id')->after('verified_by')->nullable();
            $table->unsignedBigInteger('approved_user_id')->after('approved_by')->nullable();

            $table->foreign('generated_user_id')->references('id')->on('users');
            $table->foreign('verified_user_id')->references('id')->on('users');
            $table->foreign('approved_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('summary_logs', function (Blueprint $table) {
            //
        });
    }
};

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
            $table->unsignedBigInteger('received_user_id')->after('received_by')->nullable();
            $table->foreign('received_user_id')->references('id')->on('users');
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

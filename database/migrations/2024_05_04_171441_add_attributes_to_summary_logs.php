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
            $table->unsignedBigInteger('principal_id')->after('hash')->nullable();
            $table->text('send_back_details')->after('file_path')->nullable();
            $table->text('send_back_by')->after('send_back_details')->nullable();
            $table->dateTime('send_back_at')->after('send_back_by')->nullable();
            $table->integer('status_id')->after('send_back_at')->default(1);
            $table->text('generated_by')->after('updated_at')->nullable();
            $table->text('verified_by')->after('generated_by')->nullable();
            $table->dateTime('verified_at')->after('verified_by')->nullable();
            $table->text('approved_by')->after('verified_at')->nullable();
            $table->dateTime('approved_at')->after('approved_by')->nullable();
            $table->text('received_by')->after('approved_at')->nullable();
            $table->dateTime('received_at')->after('received_by')->nullable();

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

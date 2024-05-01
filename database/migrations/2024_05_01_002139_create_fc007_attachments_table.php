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
        Schema::create('fc007_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fc_log_id')->nullable();
            $table->unsignedBigInteger('attachment_type_id')->nullable();
            $table->text('hash')->nullable();
            $table->text('description')->nullable();
            $table->text('filepath')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('fc_log_id')->references('id')->on('fc007_logs');
            $table->foreign('attachment_type_id')->references('id')->on('attachment_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fc007_attachments');
    }
};

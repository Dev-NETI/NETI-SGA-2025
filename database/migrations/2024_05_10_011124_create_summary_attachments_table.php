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
        Schema::create('summary_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('summary_log_id')->nullable();
            $table->unsignedBigInteger('attachment_type_id')->nullable();
            $table->text('hash')->nullable();
            $table->text('description')->nullable();
            $table->text('filepath')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary_attachments');
    }
};

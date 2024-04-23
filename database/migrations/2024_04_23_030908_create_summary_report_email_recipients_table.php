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
        Schema::create('summary_report_email_recipients', function (Blueprint $table) {
            $table->id();
            $table->integer('process_id')->default(NULL)->comment('1 - generate board , 2 - verification board , 3 - approval board');
            $table->unsignedBigInteger('user_id')->default(NULL);
            $table->boolean('is_active')->default(true);
            $table->text('modified_by')->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary_report_email_recipients');
    }
};

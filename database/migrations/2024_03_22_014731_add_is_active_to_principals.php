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
        Schema::table('principals', function (Blueprint $table) {
            $table->text('hash')->nullable('')->after('id');
            $table->boolean('is_active')->default(true)->after('name');
            $table->string('modified_by')->after('is_active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('principals', function (Blueprint $table) {
            //
        });
    }
};

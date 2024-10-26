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
        Schema::create('tanaman_subkriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanamans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('subkriteria_id')->constrained('subkriterias')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman_subkriterias');
    }
};

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
        Schema::create('insight_pages', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->longText('paragraph')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('created_by')->nullable();
            $table->longText('note')->nullable();
            $table->string('date')->nullable();
            $table->foreignId('cat_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insight_pages');
    }
};

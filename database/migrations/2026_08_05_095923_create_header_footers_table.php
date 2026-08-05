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
        Schema::create('header_footers', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('location')->nullable();
            $table->string('whatsappIcon')->nullable();
            $table->string('phoneIcon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_footers');
    }
};

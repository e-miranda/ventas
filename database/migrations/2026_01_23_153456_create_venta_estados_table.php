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
        
        Schema::create('venta_estados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('estado_anterior');
            $table->unsignedTinyInteger('estado_nuevo');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_estados');
    }
};

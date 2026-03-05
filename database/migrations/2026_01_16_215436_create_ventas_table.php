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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('producto_id')->constrained()->cascadeOnDelete();

            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);

            $table->string('nombre_comprador');
            $table->string('telefono')->nullable();
            $table->string('email_deposito')->nullable();

            $table->string('autorizacion')->nullable(); // nro operación
            $table->string('imagen')->nullable(); // comprobante

            $table->boolean('habilitado')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};

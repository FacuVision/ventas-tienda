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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relacionado al usuario
            $table->timestamp('login_time'); // Fecha y hora de ingreso
            $table->string('ip_address', 45); // IP pública
            $table->string('browser'); // Navegador
            $table->text('device_info')->nullable(); // Información del dispositivo
            $table->string('user_agent'); // Agente de usuario completo
            $table->timestamps();

            // Llave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};

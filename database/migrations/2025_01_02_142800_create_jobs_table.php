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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->enum('status', ['activo','inactivo'])->default('activo');
            $table->enum('pay_status', ['pendiente','cancelado','con observaciones'])->default('pendiente');

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->unsignedBigInteger('computer_id');

            $table->foreign('computer_id')
            ->references('id')
            ->on('computers');

            $table->string("observations");

            $table->dateTime('end_datetime')->nullable(); //fecha en la que cierra la jornada
            $table->timestamps(); //incluye la fecha de creacion y la fecha de actualizacion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

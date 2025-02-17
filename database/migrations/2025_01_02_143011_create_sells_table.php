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
        Schema::create('sells', function (Blueprint $table) {


            $table->id();
            $table->string("description");

            $table->decimal('mount', 8, 2);

            $table->enum('status', ['activo','inactivo'])->default('activo');

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')
            ->references('id')
            ->on('jobs');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories');

            $table->string("payment_type_sell");

            //efectivo
            //yape
            //transferencia bancaria
            //plin


            $table->string("observations");

            $table->timestamps(); //incluye la fecha de creacion y la fecha de actualizacion


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sells');
    }
};

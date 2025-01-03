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
        Schema::create('sell_reports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')
            ->references('id')
            ->on('jobs');

            $table->decimal('total_mount', 8, 2);
            //monto total (recaudado general + papeleria)

            $table->decimal('box_mount', 8, 2);
            //monto de caja - solo transferencias

            $table->decimal('total_only_paper', 8, 2);
            //monto de solo papeleria

            $table->decimal('total_only_sell', 8, 2);
            // monto de solo ventas

            $table->decimal('real_worker_pay', 8, 2);
            //monto de 50% real

            $table->decimal('worker_pay', 8, 2);
            //monto de 50% real - trabajador

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_reports');
    }
};

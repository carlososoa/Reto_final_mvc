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
        Schema::create('programa_educativo_asignaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programa_educativo_id');
            $table->unsignedBigInteger('asignatura_id');
            $table->timestamps();
            
            $table->foreign('programa_educativo_id')->references('id')->on('programa_educativos');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_educativo_asignaturas');
    }
};

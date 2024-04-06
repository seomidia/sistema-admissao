<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('admission_id');
            $table->string('dia_semana')->nullable();
            $table->time('h_entrada_manha')->nullable();
            $table->time('h_saida_manha')->nullable();
            $table->time('h_entrada_tarde')->nullable();
            $table->time('h_saida_tarde')->nullable();
            $table->time('h_entrada_noite')->nullable();
            $table->time('h_saida_noite')->nullable();
            $table->string('folga')->default('off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}

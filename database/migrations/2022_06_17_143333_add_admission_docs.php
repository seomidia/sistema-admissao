<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdmissionDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->string('cedula_identidade')->nullable();
            $table->string('cpf')->nullable();
            $table->string('titulo_eleitor')->nullable();
            $table->string('pis')->nullable();
            $table->string('cert_reservista')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn('cedula_identidade');
            $table->dropColumn('cpf');
            $table->dropColumn('titulo_eleitor');
            $table->dropColumn('pis');
            $table->dropColumn('cert_reservista');
        });
    }
}

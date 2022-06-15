<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->integer('companies_id');
            $table->string("cnpj")->nullable();
            $table->string("razao_social")->nullable();
            $table->string("nome_fantasia")->nullable();
            $table->string("nome")->nullable();
            $table->string("sexo")->nullable();
            $table->string("endereco")->nullable();
            $table->string("numero")->nullable();
            $table->string("complemento")->nullable();
            $table->string("bairro")->nullable();
            $table->string("cidade")->nullable();
            $table->string("estado")->nullable();
            $table->string("cep")->nullable();
            $table->string("nacionalidade")->nullable();
            $table->string("loca_nascimento")->nullable();
            $table->date("nascimento")->nullable();
            $table->string("tipo_deficiencia")->default('nao possue')->nullable();
            $table->string("cor")->nullable();
            $table->string("email")->nullable();
            $table->string("fone")->nullable();
            $table->string("celular")->nullable();
            $table->string("nome_pai")->nullable();
            $table->string("nome_mae")->nullable();
            $table->string("estado_civil")->nullable();
            $table->string("nome_esposa")->nullable();
            $table->string("esposa_nascimento")->nullable();
            $table->string("escolaridade")->nullable();
            $table->integer("vale_transporte")->default(0)->nullable();
            $table->string("vt_modalidade")->default('ir_casa')->nullable();
            $table->float("vt_desconto")->default(0.00)->nullable();
            $table->date("dt_admissao")->nullable();
            $table->string("cargo")->nullable();
            $table->string("salario")->nullable();
            $table->string("experiencia_dias")->default(0)->nullable();
            $table->string("modalidade")->default('mensalista')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}

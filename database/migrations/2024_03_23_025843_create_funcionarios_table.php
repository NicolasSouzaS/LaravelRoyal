<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('fotoFuncionario',255);
            $table->string('nomeFuncionario', 100);
            $table->string('sobrenomeFuncionario', 200);
            $table->string('numeroFuncionario', 11);
            $table->string('emailFuncionario', 255);
            $table->string('especialidadeFuncionario', 100);
            $table->time('inicioExpedienteFuncionario');
            $table->time('fimExpedienteFuncionario');
            $table->string('cargoFuncionario', 30);
            $table->integer('qntCortesFuncionario');
            $table->double('valorCorteFuncionario', 10,2);
            $table->double('salarioFuncionario', 10,2);
            $table->string('statusFuncionario', 10);
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
        Schema::dropIfExists('funcionarios');
    }
};

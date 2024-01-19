<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIoVeiculosTable extends Migration
{
    public function up()
    {
        Schema::table('io_veiculos', function (Blueprint $table) {
            $table->unsignedBigInteger('responsavel_user_id')->nullable();
            $table->foreign('responsavel_user_id', 'responsavel_user_fk_6455530')->references('id')->on('users');
            $table->unsignedBigInteger('secao_id')->nullable();
            $table->foreign('secao_id', 'secao_fk_6455531')->references('id')->on('secoes');
            $table->unsignedBigInteger('veiculo_id')->nullable();
            $table->foreign('veiculo_id', 'veiculo_fk_6455532')->references('id')->on('veiculos');
        });
    }
}

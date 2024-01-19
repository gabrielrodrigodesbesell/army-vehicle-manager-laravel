<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIoPessoasTable extends Migration
{
    public function up()
    {
        Schema::table('io_pessoas', function (Blueprint $table) {
            $table->unsignedBigInteger('responsavel_user_id')->nullable();
            $table->foreign('responsavel_user_id', 'responsavel_user_fk_6455521')->references('id')->on('users');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6455522')->references('id')->on('users');
            $table->unsignedBigInteger('secao_id')->nullable();
            $table->foreign('secao_id', 'secao_fk_6455523')->references('id')->on('secoes');
        });
    }
}

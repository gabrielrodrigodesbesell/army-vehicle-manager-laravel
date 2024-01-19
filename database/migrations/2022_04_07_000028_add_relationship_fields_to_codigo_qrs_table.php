<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCodigoQrsTable extends Migration
{
    public function up()
    {
        Schema::table('codigo_qrs', function (Blueprint $table) {
            $table->unsignedBigInteger('veiculo_id')->nullable();
            $table->foreign('veiculo_id', 'veiculo_fk_6389194')->references('id')->on('veiculos');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6389195')->references('id')->on('users');
        });
    }
}

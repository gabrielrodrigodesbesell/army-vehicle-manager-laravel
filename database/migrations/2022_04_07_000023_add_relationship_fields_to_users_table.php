<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('grupo_id')->nullable();
            $table->foreign('grupo_id', 'grupo_fk_5417825')->references('id')->on('grupos');
            $table->unsignedBigInteger('graduacao_id')->nullable();
            $table->foreign('graduacao_id', 'graduacao_fk_5576742')->references('id')->on('graduacaos');
        });
    }
}

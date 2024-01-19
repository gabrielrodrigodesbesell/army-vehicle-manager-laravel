<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduacaosTable extends Migration
{
    public function up()
    {
        Schema::create('graduacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

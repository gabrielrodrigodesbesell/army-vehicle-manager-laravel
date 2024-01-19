<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoQrsTable extends Migration
{
    public function up()
    {
        Schema::create('codigo_qrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CM_cliente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->string('apellido_materno');
            $table->string('apellido_paterno');
            $table->string('email');
            $table->string('usuario', 16);
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8';
            $table->collation ='utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domicilio');
    }
}

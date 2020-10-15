<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class domicilio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CM_domicilio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('calle_1');
            $table->string('calle_2');
            $table->string('colonia');
            $table->integer('codigoPostal');
            $table->string('ciudad');
            $table->string('municipio');
            $table->string('estado');
            $table->string('pais');
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
        Schema::dropIfExists('CM_domicilio');
    }
}

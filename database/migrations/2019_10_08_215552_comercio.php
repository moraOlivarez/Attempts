<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class comercio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CM_comercio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 50)->unique();
            $table->integer('direccion_id');
            $table->integer('cliente_id');
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8';
            $table->collation ='utf8_general_ci';
        });
    }

            //     $table->unsignedInteger('id_catEtapa');
          

            // $table->foreign('id_catEtapa')->references('id')->on('lProcesos_CatEtapas');

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CM_comercio');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class comercioEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CM_comercioEstado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('comercio_id');
            $table->string('estado');
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
        Schema::dropIfExists('CM_comercioEstado');
    }
}

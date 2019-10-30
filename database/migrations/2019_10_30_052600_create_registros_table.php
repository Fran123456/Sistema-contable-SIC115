<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fecha');
            $table->unsignedBigInteger('cuenta_id');
            $table->string('monto');
            $table->text('descripcion')->nullable();
            $table->string('estado');
            $table->timestamps();


            //relaciones ->onDelete('set null')
            $table->foreign('cuenta_id')->references('id')->on('cuentas');


            //others
            $table->charset = 'utf8';   
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}

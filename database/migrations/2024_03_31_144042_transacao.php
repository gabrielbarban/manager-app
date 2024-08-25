<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacao', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('desc')->nullable();
            $table->integer('transacao_tipo_id');
            $table->string('status');
            $table->decimal('valor', 8, 2)->nullable();
            $table->integer('cliente_id');
            $table->integer('usuario_id');
            $table->timestamp('data_liquidacao')->nullable();
            $table->string('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacao');
    }
}

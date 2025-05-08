<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntidadesFK extends Migration
{
    public function up()
    {
        Schema::table('transacao', function (Blueprint $table) {
            $table->integer('entidade_id')->nullable(false)->after('obs');
        });

        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('entidade_id')->nullable(false)->after('senha');
        });

        Schema::table('categoria', function (Blueprint $table) {
            $table->integer('entidade_id')->nullable(false)->after('nome');
        });

        Schema::table('empresa', function (Blueprint $table) {
            $table->integer('entidade_id')->nullable(false)->after('obs');
        });

        Schema::table('transacao_tipo', function (Blueprint $table) {
            $table->integer('entidade_id')->nullable(false)->after('titulo');
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->integer('entidade_id')->nullable(false)->after('ativo');
        });

        Schema::table('transacao_produtos', function (Blueprint $table) {
            $table->integer('entidade_id')->nullable(false)->after('produto_id');
        });
    }

    public function down()
    {
        Schema::table('transacao', function (Blueprint $table) {
            $table->dropColumn('entidade_id');
        });

        Schema::table('usuario', function (Blueprint $table) {
            $table->dropColumn('entidade_id');
        });

        Schema::table('categoria', function (Blueprint $table) {
            $table->dropColumn('entidade_id');
        });

        Schema::table('empresa', function (Blueprint $table) {
            $table->dropColumn('entidade_id');
        });

        Schema::table('transacao_tipo', function (Blueprint $table) {
            $table->dropColumn('entidade_id');
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('entidade_id');
        });

        Schema::table('transacao_produtos', function (Blueprint $table) {
            $table->dropColumn('entidade_id');
        });
    }
}

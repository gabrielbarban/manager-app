<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
        $table->id();
        $table->string('symbol')->default('BTC');
        $table->decimal('amount_brl', 15, 2);
        $table->decimal('amount_crypto', 18, 8);
        $table->decimal('buy_price', 18, 8);
        $table->enum('status', ['aguardando_venda', 'vendido'])->default('aguardando_venda');
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
        Schema::dropIfExists('trades');
    }
}

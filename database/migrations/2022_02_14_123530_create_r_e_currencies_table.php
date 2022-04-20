<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_e_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('symbol', 10);
            $table->unsignedTinyInteger('is_prefix_symbol')->default(0);
            $table->unsignedTinyInteger('decimals')->default(0);
            $table->boolean('is_default')->default(false);
            $table->double('exchange_rate')->default(1);
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
        Schema::dropIfExists('r_e_currencies');
    }
};

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
        Schema::create('model_review', function (Blueprint $table) {
            $table->id();
            $table->morphs('mode');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('review')->nullable();
            $table->integer('rating');
            $table->text('reply')->nullable();
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('model_review');
    }
};

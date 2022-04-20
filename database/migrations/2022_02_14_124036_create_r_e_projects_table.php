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
        Schema::create('r_e_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300);
            $table->text('content')->nullable();
            $table->text('images')->nullable();
            $table->string('location', 255)->nullable();
            $table->unsignedSmallInteger('number_block')->nullable()->comment('Khu');
            $table->smallInteger('number_floor')->nullable()->comment('Tầng lầu');
            $table->smallInteger('number_flat')->nullable()->comment('Mặt bằng');
            $table->date('date_finish')->nullable();
            $table->date('date_sell')->nullable();
            $table->string('description', 400)->nullable();
            $table->decimal('price_from', 15, 0)->nullable();
            $table->decimal('price_to', 15, 0)->nullable();
            $table->string('latitude', 25)->nullable()->comment('Vĩ độ');
            $table->string('longitude', 25)->nullable()->comment('Kinh độ');
            $table->boolean('is_featured')->default(false);
            $table->string('status', 60)->default('selling');
            // Relationships
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('investor_id')
                ->constrained('r_e_investors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('currency_id')
                ->constrained('r_e_currencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('city_id')
                ->constrained('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // End Relationships
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
        Schema::dropIfExists('r_e_projects');
    }
};

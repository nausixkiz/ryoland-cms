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
        Schema::create('r_e_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300);
            $table->longText('content')->nullable();
            $table->string('location', 255)->nullable();
            $table->text('images')->nullable();
            $table->unsignedSmallInteger('number_bedroom')->nullable();
            $table->unsignedSmallInteger('number_bathroom')->nullable();
            $table->unsignedSmallInteger('number_floor')->nullable();
            $table->integer('square')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('price_unit', 120)->nullable();
            $table->string('type', 20)->default('sale');
            $table->string('description', 400)->nullable();
            $table->string('period', 30)->default('month');
            $table->string('moderation_status', 60)->default('pending');
            $table->date('expire_date')->nullable();
            $table->string('latitude', 25)->nullable()->comment('Vĩ độ');
            $table->string('longitude', 25)->nullable()->comment('Kinh độ');
            $table->boolean('auto_renew')->default(false);
            $table->boolean('never_expired')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('status', 60)->default('selling');
            // Relationships
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('project_id')
                ->constrained('r_e_projects')
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
        Schema::dropIfExists('r_e_properties');
    }
};

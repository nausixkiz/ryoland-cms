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
        Schema::create('r_e_consults', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 60);
            $table->string('phone', 60);
            $table->uuid('project_uuid');
            $table->uuid('property_uuid');
            $table->text('content')->nullable();
            $table->string('status', 60)->default('unread');
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
        Schema::dropIfExists('r_e_consults');
    }
};

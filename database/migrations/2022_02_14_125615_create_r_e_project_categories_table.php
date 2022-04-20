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
        Schema::create('r_e_project_categories', function (Blueprint $table) {
            // Relationships
            $table->foreignId('project_id')
                ->constrained('r_e_projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('category_id')
                ->constrained('r_e_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // End Relationships
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_e_project_categories');
    }
};

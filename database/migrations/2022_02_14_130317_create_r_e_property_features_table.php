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
        Schema::create('r_e_property_features', function (Blueprint $table) {
            // Relationships
            $table->foreignId('property_id')
                ->constrained('r_e_properties')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('feature_id')
                ->constrained('r_e_features')
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
        Schema::dropIfExists('r_e_property_features');
    }
};

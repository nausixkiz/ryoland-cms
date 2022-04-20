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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('amount', 15, 2);
            $table->string('currency', 120)->nullable();
            $table->string('charge_id', 60)->nullable()->comment('Stripe charge id');
            $table->string('payment_channel', 60)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('payment_type')->default('confirm');
            $table->unsignedDecimal('refunded_amount', 15, 2)->nullable();
            $table->string('refund_note', 255)->nullable();
//            $table->mediumText('metadata')->nullable();
            $table->string('status', 60)->default('pending');
            // Relationships
            $table->foreignId('user_id')
                ->constrained('users')
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
        Schema::dropIfExists('payments');
    }
};

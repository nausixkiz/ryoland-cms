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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->from(1000000000);
            $table->string('name');
            $table->string('slug');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('gender', 60)->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
            // Laravel Socialite
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('github_id')->nullable();
            $table->string('zalo_id')->nullable();
            // End Laravel Socialite
            $table->boolean('status')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};

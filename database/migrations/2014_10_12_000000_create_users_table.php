<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->bigInteger('account_id')->nullable();
            $table->integer('reputation');
            $table->integer('views')->default(0);
            $table->integer('down_votes')->default(0);
            $table->integer('up_votes')->default(0);


            $table->string('display_name', 255);
            $table->string('location', 512)->nullable();
            $table->string('profile_image_url', 255)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->longText('about_me')->nullable();


            $table->timestamp('last_access_date')->nullable();

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
}

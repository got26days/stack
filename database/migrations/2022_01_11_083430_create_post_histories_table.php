<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_histories', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('post_id');
            $table->bigInteger('user_id')->nullable();
            $table->integer('post_history_type_id');

            $table->string('content_license', 64)->nullable();

            $table->uuid('revision_guid')->nullable();

            $table->longText('text')->nullable();
            $table->longText('comment')->nullable();

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
        Schema::dropIfExists('post_histories');
    }
}

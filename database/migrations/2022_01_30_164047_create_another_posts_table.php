<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnotherPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('another_posts', function (Blueprint $table) {
            $table->id();

            $table->integer('owner_user_id')->nullable();
            $table->integer('last_editor_user_id')->nullable();
            $table->smallInteger('post_type_id');

            $table->integer('accepted_answer_id')->nullable();

            $table->smallInteger('score');

            $table->integer('parent_id')->nullable();
            $table->smallInteger('view_count')->nullable()->default(0);
            $table->smallInteger('answer_count')->nullable()->default(0);
            $table->smallInteger('comment_count')->nullable()->default(0);
            $table->string('owner_display_name', 64)->nullable();
            $table->string('last_editor_display_name', 64)->nullable();
            $table->string('title', 512)->nullable();
            $table->string('tags', 512)->nullable();
            $table->string('content_license', 64);

            $table->longText('body')->nullable();

            $table->smallInteger('favorite_count')->nullable()->default(0);

            $table->timestamp('community_owned_date')->nullable();
            $table->timestamp('closed_date')->nullable();
            $table->timestamp('last_edit_date')->nullable();
            $table->timestamp('last_activity_date')->nullable();


            $table->index('parent_id');
            $table->index('created_at');
            $table->index('score');

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
        Schema::dropIfExists('another_posts');
    }
}

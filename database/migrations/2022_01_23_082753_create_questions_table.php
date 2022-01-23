<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->integer('owner_user_id')->nullable();
            $table->integer('last_editor_user_id')->nullable();

            $table->integer('accepted_answer_id')->nullable();

            $table->integer('score');

            $table->integer('parent_id')->nullable();
            $table->integer('view_count')->nullable()->default(0);
            $table->integer('answer_count')->nullable()->default(0);
            $table->integer('comment_count')->nullable()->default(0);
            $table->string('owner_display_name', 64)->nullable();
            $table->string('last_editor_display_name', 64)->nullable();
            $table->string('title', 512)->nullable();
            $table->string('tags', 512)->nullable();
            $table->string('content_license', 64);

            $table->longText('body')->nullable();

            $table->integer('favorite_count')->nullable()->default(0);

            $table->timestamp('community_owned_date')->nullable();
            $table->timestamp('closed_date')->nullable();
            $table->timestamp('last_edit_date')->nullable();
            $table->timestamp('last_activity_date')->nullable();


            $table->index(['created_at', 'score', 'closed_date']);

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
        Schema::dropIfExists('questions');
    }
}

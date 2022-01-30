<?php

namespace App\Console\Commands;

use App\Models\AnotherPost;
use App\Models\Answer;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\PostTagSecond;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CachePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // $post_tag = PostTag::query()->chunk(
        //     30000,
        //     function ($post_tag) {
        //         foreach ($post_tag as $tag) {
        //             $pt = Post::where('id', $tag->post_id)->latest()->first();
        //             if (!$pt) {
        //                 $tag->delete();
        //                 $this->line($tag->id);
        //             }
        //         }
        //     }
        // );

        // return 0;

        // Post::where('id', '<=', 38906610)->where('post_type_id', 1)->chunk(
        //     30000,
        //     function ($posts) {
        //         foreach ($posts as $post) {
        //             $post->delete();
        //         }


        //         $this->line('d');
        //     }
        // );

        // $posts = Question::where('id', '>=', 60033170)->chunk(30000, function ($posts) {
        //     foreach ($posts as $post) {

        //         if (count($post->tagsArray) > 0) {
        //             foreach ($post->tagsArray as $tag_name) {

        //                 $tag = cache()->remember('tag_name' . $tag_name, 60 * 60 * 24, function () use ($tag_name) {
        //                     return Tag::where('tag_name', $tag_name)->first();
        //                 });


        //                 if ($tag) {
        //                     $post->tagsRelationship()->attach($tag->id);
        //                 }
        //             }
        //         }
        //     }

        //     $this->line($posts[0]->id);
        // });

        $pts = AnotherPost::where('post_type_id', 1)
            ->where('id', '!=', 237725)
            ->chunkById(
                10000,
                function ($posts) {
                    $this->line($posts[0]->id);
                    foreach ($posts as $post) {

                        $a = Question::where('id', $post->id)->first();
                        if (!$a) {
                            $q = new Question();
                            // $q->post_type_id = $post->post_type_id;
                            $q->owner_user_id = $post->owner_user_id;
                            $q->last_editor_user_id = $post->last_editor_user_id;
                            $q->accepted_answer_id = $post->accepted_answer_id;
                            $q->score = $post->score;
                            $q->parent_id = $post->parent_id;
                            $q->view_count = $post->view_count;
                            $q->answer_count = $post->answer_count;
                            $q->comment_count = $post->comment_count;
                            $q->owner_display_name = $post->owner_display_name;
                            $q->last_editor_display_name = $post->last_editor_display_name;
                            $q->title = $post->title;
                            $q->tags = $post->tags;
                            $q->content_license = $post->content_license;
                            $q->body = $post->body;
                            $q->favorite_count = $post->favorite_count;
                            $q->community_owned_date = $post->community_owned_date;
                            $q->closed_date = $post->closed_date;
                            $q->last_edit_date = $post->last_edit_date;
                            $q->last_activity_date = $post->last_activity_date;
                            $q->created_at = $post->created_at;
                            $q->id = $post->id;
                            $q->updated_at = $post->updated_at;
                            $q->save();
                        }

                        $post->delete();
                    }
                }
            );


        return 0;
    }
}

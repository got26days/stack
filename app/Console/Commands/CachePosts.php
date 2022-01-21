<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Console\Command;

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

        $posts = Post::where('id', '>=', 48751571)
            ->where('post_type_id', 1)->chunk(30000, function ($posts) {
                foreach ($posts as $post) {

                    if (count($post->tagsArray) > 0) {

                        foreach ($post->tagsArray as $tag_name) {

                            $tag = cache()->remember('tag_name' . $tag_name, 60 * 60 * 24, function () use ($tag_name) {
                                return Tag::where('tag_name', $tag_name)->first();
                            });


                            if ($tag) {
                                $post->tagsRelationship()->attach($tag->id);
                            }
                        }
                    }

                    $this->line($post->id);
                }
            });


        return 0;
    }
}

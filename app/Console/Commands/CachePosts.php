<?php

namespace App\Console\Commands;

use App\Models\Post;
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

        $posts = Post::latest()->limit(10)->get();

        foreach ($posts as $post) {
            $this->line($post->created_at);
        }

        return 0;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostHistory;
use App\Models\PostLink;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index(Request $request)
    {

        return 'test';
    }

    public function test()
    {
        $posts = Post::where('post_type_id', 1)
            ->where('tags', 'LIKE', "%php%")
            ->latest()->limit(10)->get();

        return $posts;
    }
}

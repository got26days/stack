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
    public function index()
    {

        $productId = DB::table('post_histories')->insertGetId(
            [
                'post_id' => 1,
                'post_history_type_id' => 1
            ]
        );

        return $productId;
    }
}

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
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainController extends Controller
{
    public function index(Request $request)
    {
        return 'test';
    }

    public function test()
    {
        return 'test';

        // Schema::table('post_tag', function (Blueprint $table) {
        //     // $table->dropIndex(['created_at_index']);
        //     $table->dropForeign(['post_id']);
        //     $table->dropForeign(['tag_id']);
        // });

        // return 'success';

        // $table->dropForeign(['currency_id']);

        // $posts = Post::where('post_type_id', 1)
        //     ->with('tagsRelationship')
        //     // ->whereRaw("MATCH(tags) AGAINST('<android>')")
        //     ->latest()->paginate(20);

        // return $posts;
    }
}

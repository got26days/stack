<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostHistory;
use App\Models\PostLink;
use App\Models\Question;
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

    function getBetween($string, $start = "", $end = "")
    {
        return preg_replace('/(.*)' . $start . '(.*)' . $end . '(.*)/s', '\2', $string);
    }

    public function search(Request $request)
    {

        $search_str = '';
        $score = null;
        $username = null;
        $answers = null;
        $isaccepted = null;
        $phase = false;
        $tagIds = [];

        $str_array = explode(" ", $request['search']);

        foreach ($str_array as $str) {

            if (str_contains($str, 'user:')) {
                $username = $this->getBetween($str, 'user:', '');
                continue;
            }

            if (str_contains($str, 'score:')) {
                $score = $this->getBetween($str, 'score:', '');
                continue;
            }

            if (str_contains($str, 'answers:')) {
                $answers = $this->getBetween($str, 'answers:', '');
                continue;
            }

            if (str_contains($str, 'isaccepted:')) {
                $isaccepted = $this->getBetween($str, 'isaccepted:', '');
                continue;
            }

            if (strlen($str) >= 3) {
                if ($str[0] == '[' && $str[strlen($str) - 1] == ']') {
                    $str = str_replace('[', '', $str);
                    $str = str_replace(']', '', $str);

                    $tag = Tag::where('tag_name', $str)->first();
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    }
                    continue;
                }
            }

            $search_str =  $search_str . ' ' . trim($str);
            $search_str = trim($search_str);
            if (strlen($search_str) >= 3) {
                if ($search_str[0] == '"' && $search_str[strlen($search_str) - 1] == '"') {
                    $phase = true;
                }
            }
        }

        $tab = 'relevance';

        if ($request['tab']) {
            $tab = $request['tab'];
        }

        $results = cache()->remember(
            request()->getRequestUri(),
            60 * 60 * 24,
            function () use ($tab, $search_str, $username, $answers, $score, $isaccepted, $tagIds, $phase) {
                $questions = Question::with('user');

                if ($search_str) {
                    $search_str = str_replace('"', '', $search_str);
                    $search_str = trim($search_str);
                    if (!$phase) {
                        $questions = $questions->where('title', 'LIKE', '%' . $search_str . '%');
                    } else {
                        $questions = $questions->where('title', $search_str);
                    }
                }

                if ($username) {
                    $questions = $questions->whereHas('user', function ($q) use ($username) {
                        $q->where('display_name', 'LIKE', '%' .  $username . '%');
                    });
                }

                if ($answers) {
                    $questions = $questions->where('answer_count', '>=', $answers);
                }

                if ($score) {
                    $questions->where("score", ">=", $score);
                }

                if ($isaccepted) {
                    $questions->where('accepted_answer_id', '!=', null);
                }

                if (count($tagIds) > 0) {

                    foreach ($tagIds as $tag) {

                        $questions->where(function ($query) use ($tag) {
                            $query->whereHas('tagsRelationship', function ($q) use ($tag) {
                                $q->where('tag_id', $tag);
                            })->orWhereHas('tagsRelationshipSecond', function ($q) use ($tag) {
                                $q->where('tag_id', $tag);
                            });
                        });
                    }
                }


                if ($tab == 'relevance') {
                    // $questions->where("closed_date", "!=", null);
                }

                if ($tab == 'voters') {
                    $questions->orderBy("score", 'desc');
                }

                if ($tab == 'newest') {
                    $questions = $questions->latest();
                }

                return $questions->limit(10)->get();
            }
        );


        foreach ($results as $post) {
            $post->slug = Str::slug($post->title, '-');
        }

        $search = $request['search'];

        return view('pages.search', compact('results', 'tab', 'search'));
    }

    public function test()
    {
        return phpinfo();

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

    public function total_ram_cpu_usage()
    {
        return sys_getloadavg();
    }
}

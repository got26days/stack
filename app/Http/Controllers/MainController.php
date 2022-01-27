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
        //RAM usage
        $free = shell_exec('free');
        $free = (string) trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $usedmem = $mem[2];
        $usedmemInGB = number_format($usedmem / 1048576, 2) . ' GB';
        $memory1 = $mem[2] / $mem[1] * 100;
        $memory = round($memory1) . '%';
        $fh = fopen('/proc/meminfo', 'r');
        $mem = 0;
        while ($line = fgets($fh)) {
            $pieces = array();
            if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                $mem = $pieces[1];
                break;
            }
        }
        fclose($fh);
        $totalram = number_format($mem / 1048576, 2) . ' GB';

        //cpu usage
        $cpu_load = sys_getloadavg();
        $load = $cpu_load[0] . '% / 100%';

        return view('details', compact('memory', 'totalram', 'usedmemInGB', 'load'));
    }
}

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
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {

        $streamer = \Prewk\XmlStringStreamer::createStringWalkerParser("database/Tags.xml");

        while ($row = $streamer->getNode()) {
            $row = simplexml_load_string($row);
            $tag = Tag::where('id', $row['Id'])->first();
            if (!$tag) {
                $tag = new Tag();
                $tag->id = $row['Id'];
                $tag->tag_name = $row['TagName'];
                $tag->count = $row['Count'];
                $tag->save();
            }
        }

        return Tag::limit(10)->get();
    }
}

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

        // $xmlString = file_get_contents(public_path('database/Tags.xml'));
        // $xmlObject = simplexml_load_string($xmlString);

        // foreach ($xmlObject as $row) {

        //     $tag = Tag::where('id', $row['Id'])->first();
        //     if (!$tag) {
        //         $tag = new Tag();
        //         $tag->id = $row['Id'];
        //         $tag->tag_name = $row['TagName'];
        //         $tag->count = $row['Count'];
        //         $tag->save();
        //     }
        // }

        // return Tag::get();

        // $xmlString = file_get_contents(public_path('database/Badges.xml'));
        // $xmlObject = simplexml_load_string($xmlString);

        // foreach ($xmlObject as $row) {

        //     $badge = Badge::where('id', $row['Id'])->first();
        //     if (!$badge) {
        //         $badge = new Badge();
        //         $badge->id = $row['Id'];
        //         $badge->user_id = $row['UserId'];
        //         $badge->class = $row['Class'];
        //         $badge->name = $row['Name'];
        //         if ($row['TagBased'] == 'True') {
        //             $badge->tag_based = 0;
        //         } else {
        //             $badge->tag_based = 1;
        //         }
        //         $badge->date = $row['Date'];
        //         $badge->save();
        //     }
        // }

        // return Badge::get();

        // $xmlString = file_get_contents(public_path('database/Comments.xml'));
        // $xmlObject = simplexml_load_string($xmlString);

        // foreach ($xmlObject as $row) {

        //     $comment = Comment::where(
        //         'id',
        //         $row['Id']
        //     )->first();
        //     if (!$comment) {
        //         $comment = new Comment();
        //         $comment->id = $row['Id'];
        //         $comment->post_id = $row['PostId'];
        //         $comment->user_id = $row['UserId'];
        //         $comment->score = $row['Score'];
        //         $comment->content_license = $row['ContentLicense'];
        //         $comment->user_display_name = $row['UserDisplayName'];
        //         $comment->text = $row['Text'];
        //         $comment->save();
        //     }
        // }

        // return Comment::get();

        // $xmlString = file_get_contents(public_path('database/PostHistory.xml'));
        // $xmlObject = simplexml_load_string($xmlString);

        // foreach ($xmlObject as $row) {
        //     $postHistory = PostHistory::where('id', $row['Id'])->first();
        //     if (!$postHistory) {
        //         $postHistory = new PostHistory();
        //         $postHistory->id = $row['Id'];
        //         $postHistory->post_id = $row['PostId'];
        //         $postHistory->user_id = $row['UserId'];
        //         $postHistory->post_history_type_id = $row['PostHistoryTypeId'];
        //         $postHistory->content_license = $row['ContentLicense'];
        //         $postHistory->revision_guid = $row['RevisionGuid'];
        //         $postHistory->text = $row['Text'];
        //         $postHistory->comment = $row['Comment'];
        //         $postHistory->save();
        //     }
        // }

        // return PostHistory::limit(10)->get();


        // $xmlString = file_get_contents(public_path('database/PostLinks.xml'));
        // $xmlObject = simplexml_load_string($xmlString);

        // foreach ($xmlObject as $row) {
        //     $postLink = PostLink::where('id', $row['Id'])->first();
        //     if (!$postLink) {
        //         // dd($row);
        //         $postLink = new PostLink();
        //         $postLink->id = $row['Id'];
        //         $postLink->related_post_id = $row['RelatedPostId'];
        //         $postLink->post_id = $row['PostId'];
        //         $postLink->link_type_id = $row['LinkTypeId'];
        //         $postLink->save();
        //     }
        // }

        // return PostLink::limit(10)->get();

        // $xmlString = file_get_contents(public_path('database/Posts.xml'));
        // $xmlObject = simplexml_load_string($xmlString);

        // foreach ($xmlObject as $row) {
        //     $post = Post::where('id', $row['Id'])->first();
        //     if (!$post) {
        //         dd($row);
        //         $post = new Post();
        //         $post->id = $row['Id'];
        //         $post->owner_user_id = $row['OwnerUserId'];
        //         $post->last_editor_user_id = $row['LastEditorUserId'];
        //         $post->post_type_id = $row['PostTypeId'];
        //         $post->accepted_answer_id = $row['AcceptedAnswerId'];
        //         $post->score = $row['Score'];
        //         $post->parent_id = $row['ParentId'];
        //         $post->view_count = $row['ViewCount'];
        //         $post->answer_count = $row['AnswerCount'];
        //         $post->comment_count = $row['CommentCount'];
        //         $post->owner_display_name = $row['OwnerDisplayName'];
        //         $post->last_editor_display_name = $row['LastEditorDisplayName'];
        //         $post->title = $row['Title'];
        //         $post->tags = $row['Tags'];
        //         $post->content_license = $row['ContentLicense'];
        //         $post->body = $row['Body'];
        //         $post->favorite_count = $row['FavoriteCount'];
        //         $post->community_owned_date = $row['CommunityOwnedDate'];
        //         $post->closed_date = $row['ClosedDate'];
        //         $post->last_edit_date = $row['LastEditDate'];
        //         $post->last_activity_date = $row['LastActivityDate'];
        //         $post->save();
        //     }
        // }

        // return Post::limit(10)->get();

        // $xmlString = file_get_contents(public_path('database/Users.xml'));
        // $xmlObject = simplexml_load_string($xmlString);

        // foreach ($xmlObject as $row) {
        //     $user = User::where('id', $row['Id'])->first();
        //     if (!$user) {
        //         // dd($row);
        //         if ($row['Id'] > 0) {
        //             $user = new User();
        //             $user->id = $row['Id'];
        //             $user->email = Str::random(10) . '@gmail.com';
        //             $user->password = bcrypt('password3');
        //             $user->account_id = $row['AccountId'];
        //             $user->reputation = $row['Reputation'];
        //             $user->views = $row['Views'];
        //             $user->down_votes = $row['DownVotes'];
        //             $user->up_votes = $row['UpVotes'];
        //             $user->display_name = $row['DisplayName'];
        //             $user->location = $row['Location'];
        //             $user->profile_image_url = $row['ProfileImageUrl'];
        //             $user->website_url = $row['WebsiteUrl'];
        //             $user->about_me = $row['AboutMe'];
        //             $user->last_access_date = $row['LastAccessDate'];
        //             $user->save();
        //         }
        //     }
        // }

        // return User::limit(10)->get();

        $xmlString = file_get_contents(public_path('database/Votes.xml'));
        $xmlObject = simplexml_load_string($xmlString);

        foreach ($xmlObject as $row) {
            $vote = Vote::where('id', $row['Id'])->first();
            if (!$vote) {
                // dd($row);
                $vote = new Vote();
                $vote->id = $row['Id'];
                $vote->user_id = $row['UserId'];
                $vote->post_id = $row['PostId'];
                $vote->vote_type_id = $row['VoteTypeId'];
                $vote->bounty_amount = $row['BountyAmount'];
                $vote->save();
            }
        }

        return Vote::limit(10)->get();
    }
}

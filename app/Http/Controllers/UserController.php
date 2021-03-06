<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $tab = 'reputation';

        if ($request['tab']) {
            $tab = $request['tab'];
        }



        $users = cache()->remember(
            request()->getRequestUri(),
            60 * 60 * 24,
            function () use ($tab) {
                $users = User::query();

                if ($tab == 'reputation') {
                    $users = $users->orderBy('reputation', 'DESC');
                }

                if ($tab == 'new users') {
                    $users = $users->orderBy('created_at');
                }

                if ($tab == 'voters') {
                    $users->orderBy(DB::raw("`up_votes` + `down_votes`"), 'desc');
                }

                $users = $users->paginate(20);

                return $users;
            }
        );

        foreach ($users as $user) {
            if ($user->created_at) {
                $user->created_at = $user->created_at->format('d.m.Y');
            }
        }

        $seo = Seo::where("page", "users")->first();
        $seo_title = '';
        $seo_description = '';
        $seo_keywords = '';
        if ($seo) {
            $seo_title = $seo->seo_title;
            $seo_description = $seo->desription;
            $seo_keywords = $seo->seo_keywords;
        }

        return view('pages.users', compact('users', 'tab', 'seo_title', 'seo_description', 'seo_keywords'));
    }


    public function search(Request $request)
    {

        $users = cache()->remember(request()->getRequestUri(), 60 * 60 * 24, function () use ($request) {
            $users = User::where('display_name', 'LIKE', "%{$request['search']}%")
                ->where('display_name', '!=', null);

            $users = $users->limit(24)->get();

            return $users;
        });

        foreach ($users as $user) {
            if ($user->created_at) {
                $user->created_at = $user->created_at->format('d.m.Y');
            }
        }

        return $users;
    }

    public function show(User $user)
    {
        $seo_title = $user->seo_title ? $user->seo_title : $user->display_name;
        $seo_description = $user->seo_description ? $user->seo_description : $user->display_name;
        $seo_keywords = $user->seo_keywords ? $user->seo_keywords : $user->display_name;

        return view('pages.user', compact('user', 'seo_title', 'seo_description', 'seo_keywords'));
    }
}

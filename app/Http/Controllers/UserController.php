<?php

namespace App\Http\Controllers;

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

        return view('pages.users', compact('users', 'tab'));
    }


    public function search(Request $request)
    {

        $users = cache()->remember(request()->getRequestUri(), 60 * 60 * 24, function () use ($request) {
            $users = User::where('display_name', 'LIKE', "%{$request['search']}%")
                ->where('display_name', '!=', null);

            $users = $users->limit(24)->get();

            return $users;
        });

        return $users;
    }
}

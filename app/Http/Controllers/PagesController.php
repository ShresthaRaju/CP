<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Discussion;
use App\Models\Channel;
use App\Models\Favorite;
use App\User;

class PagesController extends Controller
{
    //render welcome page
    public function welcome()
    {
        $discussions=Discussion::latest()->paginate(10);
        return view('pages.welcome', compact('discussions'));
    }

    //renders most popular discussions
    public function popular()
    {
        $discussions=Discussion::withCount('replies')->orderBy('replies_count', 'desc')->paginate(10);
        return view('pages.popular', compact('discussions'));
    }

    //renders discussions based on channel
    public function channel($channelTitle)
    {
        // $channel = Channel::with(['discussions' => function ($query) {
        //     $query->latest()->paginate(1);
        // }])->where('title', $channelTitle)->first();
        //
        // return view('pages.channel', compact('channel'));

        $discussions = Discussion::whereHas('channel', function ($query) use ($channelTitle) {
            $query->where('title', $channelTitle);
        })->latest()->paginate(10);

        return view('pages.channel', compact('discussions'));
    }

    //renders user profile
    public function userProfile($username)
    {
        $user=User::where('username', $username)->first();
        return view('user.profile', compact('user'));
    }

    //favorite a discussion

    public function favorite(Request $request)
    {
        $user=auth()->user();
        $discussion_id=$request->discussion;
        $isFavoritedAlready=$user->favorites()->where('discussion_id', $discussion_id)->first();
        if ($isFavoritedAlready) {
            $isFavoritedAlready->delete();
        } else {
            $favorite=new Favorite();
            $favorite->user_id=$user->id;
            $favorite->discussion_id=$discussion_id;
            if ($favorite->save()) {
                return ['message'=>'Discussion added to your favorites'];
            }
        }
    }
}

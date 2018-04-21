<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Discussion;
use App\Models\Channel;
use App\Models\Favorite;
use App\User;
use App\Notifications\DiscussionFavorited;
use Carbon\Carbon;

class PagesController extends Controller
{
    //render welcome page
    public function welcome()
    {
        $discussions=Discussion::latest()->paginate(10);
        return view('pages.welcome', compact('discussions'));
    }

    //renders most popular discussions
    public function popularDiscussions()
    {
        $popularDiscussions=Discussion::withCount('replies')->orderBy('replies_count', 'desc')->paginate(10);
        return view('pages.popularDiscussions', compact('popularDiscussions'));
    }

    //renders discussions that are posted within current week
    public function popularDiscussionsThisWeek()
    {
        $discussions=Discussion::whereBetween('created_at', [Carbon::now()->subWeek(),Carbon::now()])->latest()->paginate(10);
        return view('pages.thisWeek', compact('discussions'));
    }

    //renders discussions that are solved
    public function solvedDiscussions()
    {
        $solvedDiscussions=Discussion::latest()->solved()->paginate(10);
        return view('pages.solvedDiscussions', compact('solvedDiscussions'));
    }

    //renders discussions that are unsolved
    public function unsolvedDiscussions()
    {
        $unsolvedDiscussions=Discussion::latest()->unsolved()->paginate(10);
        return view('pages.unsolvedDiscussions', compact('unsolvedDiscussions'));
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
                $favorite->discussion->user->notify(new DiscussionFavorited($favorite->discussion, $favorite->user));
                return ['message'=>'Discussion added to your favorites'];
            }
        }
    }
}

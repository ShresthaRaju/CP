<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Discussion;
use App\Models\Channel;

class PagesController extends Controller
{
    public function welcome()
    {
        $discussions=Discussion::latest()->paginate(10);
        return view('pages.welcome', compact('discussions'));
    }

    public function popular()
    {
        $discussions=Discussion::withCount('replies')->orderBy('replies_count', 'desc')->paginate(10);
        return view('pages.popular', compact('discussions'));
    }

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
}

<?php

namespace App\Http\Controllers\User;

use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Channel;
use App\Http\Requests\users\DiscussionCreateValidation;
use App\Http\Requests\users\DiscussionUpdateValidation;

class DiscussionsController extends Controller
{
    //middleware (auth)
    public function __construct()
    {
        $this->middleware('auth')->except('show');

        //checks if currently logged in user is same as the one who created the discussion [for editing the discussion]
        $this->middleware('checkUser')->only('edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channels=Channel::all();
        return view('user.discussion.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionCreateValidation $request)
    {
        $discussion=new Discussion();
        $discussion->title=$request->title;
        $discussion->slug=str_slug($request->title);
        $discussion->description=$request->description;
        $discussion->channel_id=$request->channel_id;
        $discussion->user_id=auth()->id();

        if ($discussion->save()) {
            auth()->user()->increment('experience', 100);
            return response()->json(['redirect'=>route('discussion.show', $discussion->slug)]);
        } else {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion=Discussion::where('slug', '=', $slug)->first();

        $isFav=false;

        if (auth()->check()) {
            $user=auth()->user();
            $isFavoritedAlready=$user->favorites()->where('discussion_id', $discussion->id)->first();
            if ($isFavoritedAlready) {
                $isFav=true;
            }
        }
        return view('user.discussion.show', compact('discussion', 'isFav'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $channels=Channel::all();
        $discussion=Discussion::where('slug', '=', $slug)->first();
        return view('user.discussion.edit', compact('discussion', 'channels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(DiscussionUpdateValidation $request, $id)
    {
        $discussion=Discussion::where('id', '=', $id)->firstOrFail();
        $discussion->channel_id=$request->channel_id;
        $discussion->title=$request->title;
        $discussion->slug=str_slug($request->title);
        $discussion->description=$request->description;

        if ($discussion->update()) {
            return response()->json(['redirect'=>route('discussion.show', $discussion->slug)]);
        } else {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
    }
}

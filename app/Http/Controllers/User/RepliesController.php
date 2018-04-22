<?php

namespace App\Http\Controllers\User;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Discussion;
use Auth;
use App\Events\NewReply;
use App\Notifications\RepliedToPost;

class RepliesController extends Controller
{
    // middleware(auth)
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Discussion $discussion)
    {
        return $discussion->replies()->with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
          'reply'=>'required'
        ]);

        $reply=$discussion->replies()->create([
          'reply'=>$request->reply,
          'user_id'=>Auth::id()
        ]);

        if ($reply) {
            auth()->user()->increment('experience', 20);
        }

        $reply=Reply::where('id', $reply->id)->with('user')->first();

        //broadcast the reply that has been created only to others [but not to the one who created]
        broadcast(new NewReply($reply))->toOthers();

        $discussionOwner=$reply->discussion->user;

        // notify the discussion owner only for other users comment
        if ($discussionOwner!=$reply->user) {
            $discussionOwner->notify(new RepliedToPost($reply->discussion, $reply->user));
        }

        return $reply;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $request->validate([
        'reply'=>'required'
      ]);

        if ($reply->update(request(['reply']))) {
            $response['message']="Your reply has been updated !";
            return response(['status'=>$response,'updatedReply'=>$reply->load('user')]);
        } else {
            return $response['message']="Error updating the reply !";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        if ($reply->delete()) {
            auth()->user()->decrement('experience', 20);
            return $response['message']="The reply has been deleted !";
        } else {
            return $response['message']="Error deleting the reply !";
        }
    }

    // mark best reply
    public function markBestReply(Discussion $discussion, Reply $reply)
    {
        $discussion->solved=1;
        $discussion->save();

        foreach ($discussion->replies as $rep) {
            if ($rep==$reply) {
                if ($rep->best_reply!=1) {
                    $rep->best_reply=1;
                    $rep->save();
                    $rep->user()->increment('awards', 1);
                }
            } else {
                $rep->best_reply=0;
                $rep->save();
            }
        }
    }
}

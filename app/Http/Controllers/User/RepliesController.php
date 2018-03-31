<?php

namespace App\Http\Controllers\User;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Discussion;
use Auth;

class RepliesController extends Controller
{
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

        $reply=Reply::where('id', $reply->id)->with('user')->first();

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
            return $response['message']="The reply has been deleted !";
        } else {
            return $response['message']="Error deleting the reply !";
        }
    }
}

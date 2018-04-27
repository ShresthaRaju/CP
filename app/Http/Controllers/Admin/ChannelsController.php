<?php

namespace App\Http\Controllers\Admin;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels=Channel::all();
        if (request()->ajax()) {
            return $channels;
        }
        return view('admin.channels.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title'=>'bail|required|string|min:2|max:30|unique:channels,title'
        ]);

        if ($channel=Channel::create(request(['title']))) {
            $response['message']="Channel added successfully :)";
        } else {
            $response['message']="Error adding the channel :(";
        }
        return response()->json(['status'=>$response,'channel'=>$channel]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return $channel->load('discussions.replies');
        // load() method loads the relationship after ther parent model has been loaded which in this case 'channel' is the parent model
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $request->validate([
          'title'=>'bail|required|string|min:2|max:30|unique:channels,title,'.$channel->id
        ]);

        if ($channel->update(request(['title']))) {
            return $response['message']="Channel updated successfully :)";
        } else {
            return $response['message']="Error updating the channel :(";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        if ($channel->delete()) {
            return $response['message']="Channel removed successfully :)";
        } else {
            return $response['message']="Error removing this channel :(";
        }
    }
}

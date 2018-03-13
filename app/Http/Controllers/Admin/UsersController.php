<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function getAllUsers()
    {
        $users=User::latest()->paginate(10);
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response=[];
        $response['error']=true;

        $request->validate([
          'name'=>'required|string|min:3|max:60',
          'email'=>'required|email|max:100',
          'password'=>'required|string|min:8|max:25',
        ]);

        request()->request->add([
          'active'=>request('active')=="on"?1:0
        ]);

        if (User::create(request(['name','email','password','active']))) {
            $response['error']=false;
            $response['message']="User was successfully created :)";
            $response['redirect']=route('admin.users.index');
        } else {
            $response['message']="Error creating the user :(";
        }

        $users=User::latest()->paginate(10);
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $response=[];
        $response['error']=true;

        if ($user->delete()) {
            $response['error']=false;
            $response['message']="User was successfully deleted :)";
        } else {
            $response['message']="Error deleting the user :(";
        }

        return response()->json($response);
    }
}

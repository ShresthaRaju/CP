<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\users\UserCreateValidation;

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
        if (request()->ajax()) {
            return response()->json($users);
        }
        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateValidation $request)
    {
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->active=$request->active=="on"?1:0;

        if ($user->save()) {
            $response['message']="User created successfully :)";
        } else {
            $response['message']="Error creating the user :(";
        }
        return response()->json(['status'=>$response,'user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return $response['message']="User deleted successfully :)";
        } else {
            return $response['message']="Error deleting the user :(";
        }
    }
}

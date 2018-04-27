<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\users\UserCreateValidation;

use Hash;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['socialize','changePassword','uploadDisplayPicture']);
    }

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
        $user->username=$request->username;
        $user->password=bcrypt($request->password);
        $user->active=$request->active=="Active"?1:0;

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


    // For user

    public function socialize(Request $request, User $user)
    {
        $request->validate([
          'github'=>'required|string',
          'linkedin'=>'required|string',
        ]);

        $user->github=$request->github;
        $user->linkedin=$request->linkedin;

        if ($user->save()) {
            return ['success'=>'Profile Updated :)'];
        }
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
          'current_password'=>'bail|required|string',
          'new_password'=>'bail|required|string|min:8',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password=bcrypt($request->new_password);
            if ($user->save()) {
                return ['success'=>'Password changed successfully :)'];
            }
        } else {
            return ['error'=>'Current password did not match'];
        }
    }

    public function uploadDisplayPicture(Request $request, User $user)
    {
        // $request->validate([
        //   'display_image'=>'required|mimes:jpeg,jpg,png'
        // ]);

        if ($request->hasFile('display_image')) {
            $image=$request->file('display_image');
            $image_name=time().'_'.$user->username.'_'.$image->getClientOriginalName();
            $directory=public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'users';
            $image->move($directory, $image_name);
        }

        $user->display_image=isset($image_name)?$image_name:$user->display_image;
        if ($user->save()) {
            return ['success'=>'Picture uploaded :)'];
        }
    }
}

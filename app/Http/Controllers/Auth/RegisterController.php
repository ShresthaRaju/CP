<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username'=>'bail|required|string|min:5|max:30|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username'=>$data['username'],
            'password' => Hash::make($data['password']),
            'verification_token'=>str_random(40),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect()->back()
        ->with('need_verification', 'One Last Step!
        Please check your email and confirm your account. Then, you may begin posting to the forum.!');

        // $this->guard()->login($user);
        //
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }

    public function verify($verification_token)
    {
        $user=User::where('verification_token', $verification_token)->firstOrFail();
        if ($user) {
            $user->update(['verification_token'=>null,'active'=>1]);
            $this->guard()->login($user);
            return redirect()->route('welcome');
        } else {
            return response()->json_encode("User Already Verified");
        }
    }
}

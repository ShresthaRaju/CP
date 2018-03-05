@extends('layouts.main')

@section('title','Sign In')

@section('main_content')
  <div class="container">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <div class="card">
            <div class="card-content">
              <h1 class="title has-text-centered">Sign In</h1>
              <form action="{{route('login')}}" method="post">
                @csrf
                <div class="field">
                  <label class="label">E-mail Address</label>
                  <div class="control has-icons-left has-icons-right">
                    <input type="email" class="input {{$errors->has('email')?'is-danger':''}}" placeholder="Your email..." name="email" value="{{ old('email') }}">
                    <span class="icon is-small is-left">
                      <i class="fa fa-envelope"></i>
                    </span>
                    @if ($errors->has('email'))
                      <span class="icon is-small is-right">
                        <i class="fa fa-exclamation-triangle"></i>
                      </span>
                    @endif
                  </div>
                    @if ($errors->has('email'))
                      <p class="help is-danger">{{$errors->first('email')}}</p>
                    @endif
                </div>

                <div class="field">
                  <label class="label">Password</label>
                  <div class="control has-icons-left has-icons-right">
                    <input type="password" class="input {{$errors->has('password')?'is-danger':''}}" placeholder="Your password..." name="password">
                    <span class="icon is-small is-left">
                      <i class="fa fa-lock"></i>
                    </span>
                    @if ($errors->has('password'))
                      <span class="icon is-small is-right">
                        <i class="fa fa-exclamation-triangle"></i>
                      </span>
                    @endif
                  </div>
                  @if ($errors->has('password'))
                    <p class="help is-danger">{{$errors->first('password')}}</p>
                  @endif
                </div>

                <div class="field">
                    <b-checkbox name="remember" {{ old('remember') ? 'checked' : ''}} class="m-t-10">Remember Me</b-checkbox>
                </div>

                <button type="submit" class="button is-primary is-outlined is-fullwidth m-t-20"><span class="icon"><i class="fa fa-sign-in"></i></span><span>Sign In</span></button>
              </form>
              <div class="columns">
                <div class="column">
                  <a href="{{route('password.request')}}" class="has-text-dark is-pulled-right m-t-10">Forgot password?</a>
                </div>
              </div>
            </div>
          </div> <!--end of .card-->
          <p class="has-text-grey-light has-text-centered m-t-20 ">New to discussion?
            <a href="{{route('register')}}" class="has-text-dark">Join Now</a>
          </p>
        </div>
      </div>
  </div>
@endsection

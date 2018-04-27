@extends('layouts.user')

@section('title','Sign In (ADMIN)')

@section('main_content')
<div class="columns">
  <div class="column is-4 is-offset-4">
    <h1 class="title has-text-centered has-text-grey">Sign In (ADMIN)</h1>
    <div class="card">
        <div class="card-content">
          <form action="{{route('admin.login.submit')}}" method="post">
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

                @if (Session::has('error'))
                  <span class="icon is-small is-right">
                    <i class="fa fa-exclamation-triangle"></i>
                  </span>
                @endif
              </div>
                @if ($errors->has('email'))
                  <p class="help is-danger">{{$errors->first('email')}}</p>
                @endif

                @if (Session::has('error'))
                  <p class="help is-danger">{{Session::get('error')}}</p>
                @endif
            </div>

            <div class="field">
              <label class="label">Password</label>
              <div class="control has-icons-left has-icons-right">
                <input type="password" class="input {{$errors->has('password')?'is-danger':''}}" placeholder="Your password..." name="password">
                <a href="{{route('admin.password.request')}}" class="has-text-grey is-pulled-right is-italic m-t-5">Forgot password?</a>
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
                <b-checkbox name="remember" {{ old('remember') ? 'checked' : ''}} class="m-t-20">Remember Me</b-checkbox>
            </div>

            <button type="submit" class="button is-primary is-outlined is-fullwidth m-t-20"><span class="icon"><i class="fa fa-sign-in"></i></span><span>Sign In</span></button>
          </form>
        </div>
      </div> <!--end of .card-->
  </div>
</div>
@endsection

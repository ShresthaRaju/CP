@extends('layouts.user')

@section('title','Join The Discussion')

@section('main_content')
<div class="columns">
  <div class="column is-4 is-offset-4">
    @if (Session::has('need_verification'))
      <b-notification>
        {{Session::get('need_verification')}}
      </b-notification>
    @endif
    <h1 class="title has-text-centered has-text-grey">Join The Discussion</h1>
    <div class="card">
        <div class="card-content">
          <form action="{{route('register')}}" method="post">
            @csrf
            <div class="field">
              <label class="label">Fullname</label>
              <div class="control has-icons-left has-icons-right">
                <input type="text" class="input {{$errors->has('name')?'is-danger':''}}" placeholder="Your fullname..." name="name" value="{{ old('name') }}">
                <span class="icon is-small is-left">
                  <i class="fa fa-user"></i>
                </span>
                @if ($errors->has('name'))
                  <span class="icon is-small is-right">
                    <i class="fa fa-exclamation-triangle"></i>
                  </span>
                @endif

              </div>
                @if ($errors->has('name'))
                  <p class="help is-danger">{{$errors->first('name')}}</p>
                @endif
            </div>

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
              <label class="label">Confirm Password</label>
              <div class="control has-icons-left has-icons-right">
                <input type="password" class="input {{$errors->has('password_confirmation')?'is-danger':''}}" placeholder="Confirm password..." name="password_confirmation">
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
                @if ($errors->has('password_confirmation'))
                  <span class="icon is-small is-right">
                    <i class="fa fa-exclamation-triangle"></i>
                  </span>
                @endif
              </div>
              @if ($errors->has('password_confirmation'))
                <p class="help is-danger">{{$errors->first('password_confirmation')}}</p>
              @endif
            </div>


            <button type="submit" class="button is-primary is-outlined is-fullwidth m-t-20">Join Now</button>
          </form>
        </div>
      </div> <!--end of .card-->
    <p class="has-text-grey-lighter has-text-centered m-t-20 ">Already have an account?
      <a href="{{route('login')}}" class="has-text-grey">Sign In</a>
    </p>
  </div>
</div>
@endsection

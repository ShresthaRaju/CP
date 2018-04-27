@extends('layouts.user')

@section('title','Reset Your Password (ADMIN)')

@section('main_content')
<div class="columns">
  <div class="column is-4 is-offset-4">
    <h1 class="title has-text-centered has-text-grey">Reset Password (ADMIN)</h1>
    <div class="card">
          <div class="card-content">
            <form action="{{url('admin/password/reset')}}" method="post">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="field">
                <label class="label">E-mail Address</label>
                <div class="control has-icons-left has-icons-right">
                  <input type="email" class="input {{$errors->has('email')?'is-danger':''}}" placeholder="Your email..." name="email" value="{{$email or old('email')}}">
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


              <button type="submit" class="button is-primary is-outlined is-fullwidth m-t-20"><span class="icon"><i class="fa fa-refresh"></i></span><span>Reset Password</span></button>
            </form>
          </div>
        </div> <!--end of .card-->
  </div>
</div>
@endsection

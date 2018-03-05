@extends('layouts.main')

@section('title','Request Password Reset Link')

@section('main_content')

  <div class="container">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <div class="card">
            <div class="card-content">
              <h1 class="title has-text-centered">Reset Password</h1>
              <form action="{{route('password.email')}}" method="post">
                @csrf
                <div class="field">
                  <label class="label">E-mail Address</label>
                  <div class="control has-icons-left has-icons-right">
                    <input type="email" class="input {{$errors->has('email')?'is-danger':''}}" placeholder="Registered e-mail address..." name="email" value="{{ old('email') }}">
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

                <button type="submit" class="button is-primary is-outlined is-fullwidth m-t-20">Send Password Reset Link</button>
              </form>

            </div>
          </div> <!--end of .card-->
          </p>
        </div>
      </div>
  </div>
@endsection
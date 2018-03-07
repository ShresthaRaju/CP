@extends('layouts.main')

@section('title','Request Password Reset Link')

@section('main_content')
<div class="container">
  <div class="columns">
    <div class="column is-4 is-offset-4">
      <h1 class="title has-text-centered has-text-grey">Reset Password</h1>
      <div class="card">
        <div class="card-content">
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

            <button type="submit" class="button is-primary is-outlined is-fullwidth m-t-20">Get Password Reset Link</button>
          </form>
        </div>
      </div> <!--end of .card-->

      {{-- Email status (sent or not)--}}
      @if (Session::has('status'))
        <p class="has-text-grey has-text-centered m-t-15">{{Session::get('status')}}</p>
      @endif

    </div>
  </div>
</div>
@endsection

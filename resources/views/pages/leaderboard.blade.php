@extends('layouts.user')

@section('title',"Leaderboard")

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters has-border">
    <div class="columns is-multiline">
      @foreach ($users as $index=>$user)
        <div class="column is-6-desktop is-12-mobile">
          <div class="columns">
            <div class="column is-11">
              <div class="media box">
                <div class="media-left">

                    <a href="{{route('userProfile',$user->username)}}">
                      <img src="{{$user->display_image?asset('images/users/'.$user->display_image):asset('images/userImage.png')}}" alt="{{$user->username}}{{"'s"}} image" class="leaderboard-image">
                    </a>

                </div>

                <div class="media-content">
                  <a href="{{route('userProfile',$user->username)}}">
                    <p class="is-size-5-desktop is-size-6-mobile is-size-6-tablet">{{$user->username}}</p>
                  </a>
                  <div class="m-t-20">
                    <div class="is-size-6-desktop is-size-7-mobile">
                      <span class="has-text-weight-bold is-size-5">{{$user->awards}}</span>
                      <span class="has-text-grey">Best Reply awards</span>
                    </div>
                    <div class="is-size-6-desktop is-size-7-mobile">
                      <span class="has-text-weight-bold is-size-5">{{$user->experience}}</span>
                      <span class="has-text-grey">XP</span>
                    </div>
                  </div>
                </div>

                <div class="media-right">
                  <span class="leaderboard-position">
                    <span>{{++$index}}</span>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    </div>
  </div>

  <div class="column">
    @include('partials._filters')
  </div>

</div>
@endsection

@extends('layouts.user')

@section('title','Solved Discussions')

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters has-border">
    @if ($solvedDiscussions->count()==0)
      <h1 class="title is-4 has-text-centered">No relevant discussion at this time.</h1>
    @endif
    @foreach ($solvedDiscussions as $discussion)
    <article class="media">
      <figure class="media-left is-hidden-mobile">
        <p class="image is-48x48">
          <a href="{{route('userProfile',$discussion->user->username)}}">
            <img src="{{$discussion->user->display_image?asset('images/users/'.$discussion->user->display_image):asset('images/userImage.png')}}" alt="User Image" class="user-image">
          </a>
        </p>
        <img src="{{asset('images/solved.png')}}" class="image is-32x32 m-l-10 m-t-5" alt="Solved" title="Solved">
      </figure>

      <div class="media-content">
        <div class="content">
          <span class="title is-6">
            <a href="{{route('channel',$discussion->channel->title)}}">{{$discussion->channel->title}}</a>
          </span>
          <p>
            <a href="{{route('discussion.show',['slug'=>$discussion->slug])}}" class="has-text-black-ter has-text-weight-semibold is-size-6 d-title">{{$discussion->title}}</a><br>
            <small>
              <span class="is-italic has-text-grey-light m-r-5">
                <i class="fa fa-clock-o"></i>{{$discussion->created_at->diffForHumans()}}
              </span>
              <span>
                BY <a href="{{route('userProfile',$discussion->user->username)}}" class="is-uppercase">{{$discussion->user->username}}</a>
              </span>
            </small>
          </p>
          <p class="disc-desc has-text-justified">
            {{substr(preg_replace('/[^A-Za-z0-9.\-]/', ' ', $discussion->description), 0 , 300)}}
            {{strlen($discussion->description)>300?'...':''}}</p>
        </div>
      </div>

      <div class="media-right is-hidden-mobile">
        <p class="title is-5 has-text-grey-light has-text-weight-bold">
          {{$discussion->replies()->count()<10?0:''}}{{$discussion->replies()->count()}}
        </p>
      </div>
    </article>
    @endforeach

    <hr>
    {{-- pagination --}}
    {{$solvedDiscussions->links('vendor.pagination.default')}}

  </div>

  <div class="column">
    @include('partials._filters')
  </div>

</div>


@endsection

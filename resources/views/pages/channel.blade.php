@extends('layouts.user')

@section('title',"Channel")

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters has-border">
    @if ($discussions->count()==0)
      <h1 class="title is-4">This Channel does not have any discussion yet.</h1>
    @endif
    @foreach ($discussions as $discussion)
    <article class="media">
      <figure class="media-left is-hidden-mobile">
        <p class="image is-48x48">
          <a href="{{route('userProfile',$discussion->user->username)}}">
            <img src="{{$discussion->user->display_image?asset('images/users/'.$discussion->user->display_image):asset('images/users/userImage.png')}}" alt="User Image" class="user-image">
          </a>
        </p>
      </figure>
      <div class="media-content">
        <div class="content">
          <span class="title is-6"><a>{{$discussion->channel->title}}</a></span>
          <p>
            <a href="{{route('discussion.show',['slug'=>$discussion->slug])}}" class="has-text-black-ter has-text-weight-semibold is-size-6 d-title">{{$discussion->title}}</a><br>
            <small>
              <span class="is-italic has-text-grey-light">
                <span class="icon"><i class="fa fa-clock-o"></i></span>{{$discussion->created_at->diffForHumans()}}
              </span>
              <span class="m-l-10">
                BY <a href="{{route('userProfile',$discussion->user->username)}}" class="is-uppercase">{{$discussion->user->username}}</a>
              </span>
            </small>
          </p>
          <p class="disc-desc has-text-justified">{{substr($discussion->description, 0 , 300)}}{{strlen($discussion->description)>300?'...':''}}</p>
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
    {{$discussions->links('vendor.pagination.default')}}
  </div>

  <div class="column">
    @include('partials._filters')
  </div>

</div>
@endsection

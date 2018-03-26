@extends('layouts.user')

@section('title','Welcome')

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters has-border">
    @foreach ($discussions as $discussion)
    <article class="media">
      <figure class="media-left">
        <p class="image is-48x48">
          <img src="{{asset('images/userImage.png')}}">
        </p>
      </figure>
      <div class="media-content">
        <div class="content">
          <span class="title is-6"><a>{{$discussion->channel->title}}</a></span>
          <p><a href="{{route('discussion.show',['slug'=>$discussion->slug])}}" class="has-text-black-ter has-text-weight-semibold is-size-6 d-title">{{$discussion->title}}</a><br>
            <small><span class="is-italic has-text-grey-light">{{$discussion->created_at->diffForHumans()}}</span><span class="m-l-10">BY <a href="#" class="is-uppercase has-text-weight-semibold">{{$discussion->user->name}}</a></span></small>
          </p>
          <p>{!!substr(strip_tags($discussion->description), 0 , 200)!!}{{strlen(strip_tags($discussion->description))>200?'...':''}}</p>
        </div>
      </div>
    </article>
    @endforeach
  </div>

  <div class="column">
    @include('partials._filters')
  </div>

</div>

{{$discussions->links('vendor.pagination.default')}}
@endsection

@extends('layouts.user')

@section('title',"$discussion->title")

@section('stylesheets')
 <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
@endsection

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters has-border">
    <p class="m-b-20"> <span class="has-text-black-ter has-text-weight-bold is-size-4">{{$discussion->title}}</span><br>
      <small><span class="is-italic has-text-grey-light">Published {{$discussion->created_at->diffForHumans()}}</span><span class="m-l-10">BY <a href="{{route('user',$discussion->user->username)}}" class="is-uppercase has-text-weight-semibold">{{$discussion->user->username}}</a></span></small>
      <br>
      @if (Auth::check() && $discussion->user->id==Auth::id())
        <b-tooltip label="Edit this discussion"
          type="is-dark"
          position="is-right"
          animated>
          <a href="{{route('discussion.edit',['slug'=>$discussion->slug])}}"><span class="icon"><i class="fa fa-pencil"></i></span></a>
        </b-tooltip>
      @endif
      @if (Auth::check())
        <Favorite :discussion="{{$discussion->id}}" :is-favorited="{{json_encode($isFav)}}"></Favorite>
      @endif
    </p>

    {{-- Vue component to show only the description of the discussion --}}
    <DiscussionDesc discussion="{{$discussion->description}}"></DiscussionDesc>

    <hr>

    {{-- Vue Replies Component --}}
    <Replies :discussion={{$discussion->id}} loggedin="{{Auth::check()}}" user="{{Auth::id()}}"></Replies>

    @guest
      <small><p class="has-text-weight-semibold has-text-centered">Please <a href="{{route('login')}}">Sign In</a> or <a href="{{route('register')}}">Create an account</a> to participate in this conversation.</p></small>
    @endguest

  </div>

  <div class="column">
    @include('partials._filters')
  </div>

</div>
@endsection

@extends('layouts.user')

@section('title',"Edit $discussion->title")

@section('stylesheets')
 <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
@endsection

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters">
    <editDiscussion :channels="{{$channels}}" :discussion="{{$discussion}}"></editDiscussion>
  </div>

  <div class="column">
    @include('partials._filters')
  </div>
</div>
@endsection

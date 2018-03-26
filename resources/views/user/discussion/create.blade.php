@extends('layouts.user')

@section('title','Create a new discussion')

@section('stylesheets')
 <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
@endsection

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters">
    <createDiscussion :channels="{{$channels}}"></createDiscussion>
  </div>

  <div class="column">
    @include('partials._filters')
  </div>
</div>
@endsection

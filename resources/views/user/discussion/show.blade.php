@extends('layouts.user')

@section('title',"$discussion->title")

@section('stylesheets')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector:'textarea',
    branding:false,
    menubar:false,
    plugins:'lists code link image emoticons codesample preview',
    code_dialog_height:200,
    code_dialog_width:400,
    codesample_dialog_height:400,
    codesample_dialog_width:400,
    toolbar:'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify numlist bullist | code link image emoticons codesample | preview',
   });
</script>
@endsection

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters has-border">
    <p class="m-b-20"> <span class="has-text-black-ter has-text-weight-bold is-size-4">{{$discussion->title}}</span><br>
      <small><span class="is-italic has-text-grey-light">Published {{$discussion->created_at->diffForHumans()}}</span><span class="m-l-10">BY <a href="#" class="is-uppercase has-text-weight-semibold">{{$discussion->user->name}}</a></span></small>
      <br>
      @if (Auth::check() && $discussion->user->id==Auth::id())
        <b-tooltip label="Edit this discussion"
          type="is-dark"
          position="is-right"
          animated>
          <a href="{{route('discussion.edit',['slug'=>$discussion->slug])}}"><span class="icon"><i class="fa fa-pencil"></i></span></a>
        </b-tooltip>
      @endif

      <b-tooltip label="Favorite this discussion"
        type="is-dark"
        position="is-right"
        animated>
        <span class="icon"><i class="fa fa-star-o"></i></span>
      </b-tooltip>
    </p>

    <p>{!!$discussion->description!!}</p>

    <hr>

    @guest
      <p class="has-text-weight-semibold has-text-centered">Please <a href="{{route('login')}}">Sign In</a> or <a href="{{route('register')}}">Create an account</a> to participate in this conversation.</p>
    @else

    {{-- Replies --}}
    <Reply :discussion="{{$discussion->id}}"></Reply>

    <hr>

    <form>
      <div class="field">
        <div class="control">
          <textarea class="textarea {{$errors->has('reply')?'is-danger':''}}" placeholder="I have something to say..." rows="8" name="reply"></textarea>
        </div>
        @if ($errors->has('reply'))
          <p class="help is-danger">{{$errors->first('reply')}}</p>
        @endif
      </div>

      <button class="button is-rounded is-success is-outlined is-pulled-right m-b-30">Post Your Reply</button>
    </form>

    @endguest

  </div>

  <div class="column">
    @include('partials._filters')
  </div>

</div>
@endsection

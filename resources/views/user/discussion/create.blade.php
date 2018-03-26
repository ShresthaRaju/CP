@extends('layouts.user')

@section('title','Create a new discussion')

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
  <div class="column is-three-quarters">
      <div class="card m-r-100">
        <div class="card-content">
          <form action="{{route('discussion.store')}}" method="post">
            @csrf

            @include('user.includes.form')

            <button type="submit" class="button is-primary is-fullwidth">Publish Discussion</button>

          </form>
        </div>
      </div>
    </div>

  <div class="column">
    @include('partials._filters')
  </div>
</div>
@endsection

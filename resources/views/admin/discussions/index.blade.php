@extends('layouts.admin')

@section('title','All Discussions')

@section('main_content')

<div class="columns is-mobile">
  <div class="column">
    <p class="title">Discussions Manager</p>
  </div>

  <div class="column is-hidden-mobile">
    <nav class="breadcrumb has-arrow-separator is-right" aria-label="breadcrumbs">
      <ul>
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li class="is-active"><a aria-current="page">All Discussions</a></li>
      </ul>
    </nav>
  </div>
</div>

<hr>

{{-- vue Discussions component --}}
<Discussions></Discussions>

@endsection

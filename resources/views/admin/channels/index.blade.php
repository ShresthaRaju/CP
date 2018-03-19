@extends('layouts.admin')

@section('title','All Channels')

@section('main_content')

<div class="columns is-mobile">
  <div class="column">
    <p class="title">Channels Manager</p>
  </div>

  <div class="column is-hidden-mobile">
    <nav class="breadcrumb has-arrow-separator is-right" aria-label="breadcrumbs">
      <ul>
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li class="is-active"><a aria-current="page">All Channels</a></li>
      </ul>
    </nav>
  </div>
</div>

<hr>

{{-- vue Channels component --}}
<Channels></Channels>

@endsection

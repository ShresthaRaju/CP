@extends('layouts.admin')

@section('title',"All Users")

@section('main_content')

<div class="columns">
  <div class="column">
    <p class="title">Users Manager</p>
  </div>

  <div class="column is-hidden-mobile">
    <nav class="breadcrumb has-arrow-separator is-right" aria-label="breadcrumbs">
      <ul>
        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li class="is-active"><a aria-current="page">All Users</a></li>
      </ul>
    </nav>
  </div>
</div>

<hr>

{{-- vue Users component --}}
<Users></Users>

@endsection

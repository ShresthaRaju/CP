@extends('layouts.user')

@section('title',"Member Profile, $user->name")

@section('stylesheets')
  <style media="screen">
    #content{
      display: none;
    }
  </style>
@endsection

@section('user_hero')
<section class="hero is-medium is-primary is-bold">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-one-third-desktop is-one-third-tablet">
          <div class="card">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="{{asset('images/n.jpg')}}" alt="Placeholder image">
              </figure>
            </div>
          </div>
        </div>

        <div class="column">
          <div id="user-details">
            <h1 class="title is-3 is-uppercase">{{'@'}}{{$user->username}}</h1>
            <p class="title is-6">Member Since <span class="has-text-weight-bold">{{$user->created_at->diffForHumans()}}</span></p>
            <button class="button is-danger">Edit Profile</button>
          </div>
        </div>

        <div class="column has-text-right">
          <div id="xp-details">
            <h1 class="title is-5 has-text-grey is-uppercase">Experience</h1>
            <h4 class="title is-1">0</h4>
            <p class="title is-5 has-text-weight-semibold">0 Best Reply Awards</p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="hero-foot">

  </div>
</section>

@endsection

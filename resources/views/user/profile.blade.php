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

<Profile :user="{{$user}}">

  @if (Auth::check() && Auth::user()->username==substr(Request()->segment(2),1))

    <Tab name="My Questions" :active="true">

      <section class="section">
        <div class="container m-t-10">
          @if ($user->discussions()->count()==0)
            <h1 class="title is-6">None... <a href="{{route('discussion.create')}}">Ask One Now</a></h1>
          @endif

          @foreach (($user->discussions)->reverse() as $discussion)
            <article class="media">
              <figure class="media-left is-hidden-mobile">
                <p class="image is-48x48">
                  <a href="{{route('userProfile',$discussion->user->username)}}">
                    <img src="{{$discussion->user->display_image?asset('images/users/'.$discussion->user->display_image):asset('images/users/userImage.png')}}" alt="User Image" class="user-image">
                  </a>
                </p>
                @if ($discussion->solved)
                  <img src="{{asset('images/solved.png')}}" class="image is-32x32 m-l-10 m-t-5" alt="Solved" title="Solved">
                @endif
              </figure>
              <div class="media-content">
                <div class="content">
                  <span class="title is-6">
                    <a href="{{route('channel',$discussion->channel->title)}}">{{$discussion->channel->title}}</a>
                  </span>
                  <p>
                    <a href="{{route('discussion.show',['slug'=>$discussion->slug])}}" class="has-text-black-ter has-text-weight-semibold is-size-6 d-title">{{$discussion->title}}</a><br>
                    <small>
                      <span class="is-italic has-text-grey-light m-r-5 is-hidden-mobile">
                        <span class="icon"><i class="fa fa-clock-o"></i></span>{{$discussion->created_at->diffForHumans()}}
                      </span>
                      <span>
                        BY <a href="{{route('userProfile',$discussion->user->username)}}" class="is-uppercase">{{$discussion->user->username}}</a>
                      </span>
                    </small>
                  </p>
                  <p class="disc-desc has-text-justified">{{substr($discussion->description, 0 , 300)}}{{strlen($discussion->description)>300?'...':''}}</p>
                </div>
              </div>

              <div class="media-right is-hidden-mobile">
                <p class="title is-5 has-text-grey-light has-text-weight-bold">
                  {{$discussion->replies()->count()<10?0:''}}{{$discussion->replies()->count()}}
                </p>
              </div>
            </article>
          @endforeach
        </div>
      </section>

    </Tab>

    <Tab name="My Favorites">

      <section class="section">
        <div class="container m-t-10">
          @if ($user->favorites()->count()==0)
            <h1 class="title is-6 has-text-centered">You have not favorited any discussion.</h1>
          @endif

          @foreach (($user->favorites)->reverse() as $favorite)
            <article class="media">
              <figure class="media-left is-hidden-mobile">
                <p class="image is-48x48">
                  <a href="{{route('userProfile',$favorite->discussion->user->username)}}">
                    <img src="{{$favorite->discussion->user->display_image?asset('images/users/'.$favorite->discussion->user->display_image):asset('images/users/userImage.png')}}" alt="User Image" class="user-image">
                  </a>
                </p>
                @if ($favorite->discussion->solved)
                  <img src="{{asset('images/solved.png')}}" class="image is-32x32 m-l-10 m-t-5" alt="Solved" title="Solved">
                @endif
              </figure>
              <div class="media-content">
                <div class="content">
                  <span class="title is-6">
                    <a href="{{route('channel',$favorite->discussion->channel->title)}}">{{$favorite->discussion->channel->title}}</a>
                  </span>
                  <p>
                    <a href="{{route('discussion.show',['slug'=>$favorite->discussion->slug])}}" class="has-text-black-ter has-text-weight-semibold is-size-6 d-title">{{$favorite->discussion->title}}</a><br>
                    <small>
                      <span class="is-italic has-text-grey-light m-r-5 is-hidden-mobile">
                        <span class="icon"><i class="fa fa-clock-o"></i></span>{{$favorite->discussion->created_at->diffForHumans()}}
                      </span>
                      <span>
                        BY <a href="{{route('userProfile',$favorite->discussion->user->username)}}" class="is-uppercase">{{$favorite->discussion->user->username}}</a>
                      </span>
                    </small>
                  </p>
                  <p class="disc-desc has-text-justified">{{substr($favorite->discussion->description, 0 , 300)}}{{strlen($favorite->discussion->description)>300?'...':''}}</p>
                </div>
              </div>

              <div class="media-right is-hidden-mobile">
                <p class="title is-5 has-text-grey-light has-text-weight-bold">
                  {{$favorite->discussion->replies()->count()<10?0:''}}{{$favorite->discussion->replies()->count()}}
                </p>
              </div>
            </article>
          @endforeach

        </div>
      </section>
    </Tab>

    <Tab name="Edit Profile">

      <section class="section">
        <div class="container m-t-10">
          <div class="columns">
            <div class="column is-one-third is-offset-one-third">
              <div class="card">
                  <div class="card-content">
                    <form action="{{route('updateUser',$user)}}" method="post" enctype="multipart/form-data">
                      @csrf
                      {{method_field('PUT')}}
                      <div class="field">
                        <label class="label">More of your details</label>
                        <div class="control has-icons-right">
                          <input type="text" class="input {{$errors->has('tname')?'is-danger':''}}" placeholder="Twitter Username..." name="tname" value="{{ old('tname') }}">
                          @if ($errors->has('tname'))
                            <span class="icon is-small is-right">
                              <i class="fa fa-exclamation-triangle"></i>
                            </span>
                          @endif

                        </div>
                          @if ($errors->has('tname'))
                            <p class="help is-danger">{{$errors->first('tname')}}</p>
                          @endif
                      </div>

                      <div class="field">
                        <div class="control has-icons-right">
                          <input type="text" class="input {{$errors->has('gname')?'is-danger':''}}" placeholder="Github Username..." name="gname" value="{{ old('gname') }}">
                          @if ($errors->has('gname'))
                            <span class="icon is-small is-right">
                              <i class="fa fa-exclamation-triangle"></i>
                            </span>
                          @endif

                        </div>
                          @if ($errors->has('gname'))
                            <p class="help is-danger">{{$errors->first('gname')}}</p>
                          @endif
                      </div>

                      <div class="field">
                        <div class="control has-icons-right">
                          <input type="text" class="input {{$errors->has('emp')?'is-danger':''}}" placeholder="Place of Employment..." name="emp" value="{{ old('emp')}}">
                          @if ($errors->has('emp'))
                            <span class="icon is-small is-right">
                              <i class="fa fa-exclamation-triangle"></i>
                            </span>
                          @endif

                        </div>
                          @if ($errors->has('emp'))
                            <p class="help is-danger">{{$errors->first('emp')}}</p>
                          @endif
                      </div>

                      <div class="field">
                        <div class="control has-icons-right">
                          <input type="text" class="input {{$errors->has('job')?'is-danger':''}}" placeholder="Job Title..." name="job" value="{{ old('job') }}">
                          @if ($errors->has('job'))
                            <span class="icon is-small is-right">
                              <i class="fa fa-exclamation-triangle"></i>
                            </span>
                          @endif

                        </div>
                          @if ($errors->has('job'))
                            <p class="help is-danger">{{$errors->first('job')}}</p>
                          @endif
                      </div>

                      <div class="field">
                        <div class="control has-icons-right">
                          <input type="text" class="input {{$errors->has('hometown')?'is-danger':''}}" placeholder="Your hometown..." name="hometown" value="{{ old('hometown') }}">
                          @if ($errors->has('hometown'))
                            <span class="icon is-small is-right">
                              <i class="fa fa-exclamation-triangle"></i>
                            </span>
                          @endif

                        </div>
                          @if ($errors->has('hometown'))
                            <p class="help is-danger">{{$errors->first('hometown')}}</p>
                          @endif
                      </div>

                      <div class="field">
                        <div class="file is-warning">
                          <label class="file-label">
                            <input class="file-input" type="file" name="display_image">
                            <span class="file-cta">
                              <span class="file-icon">
                                <i class="fa fa-upload"></i>
                              </span>
                              <span class="file-label">
                                Choose a profile photo...
                              </span>
                            </span>
                          </label>
                        </div>
                      </div>

                      <div class="field">
                        <label class="label">Change Password</label>
                        <div class="control has-icons-left has-icons-right">
                          <input type="password" class="input {{$errors->has('password')?'is-danger':''}}" placeholder="Current password..." name="current_password">
                          <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                          </span>
                          @if ($errors->has('password'))
                            <span class="icon is-small is-right">
                              <i class="fa fa-exclamation-triangle"></i>
                            </span>
                          @endif
                        </div>
                        @if ($errors->has('password'))
                          <p class="help is-danger">{{$errors->first('password')}}</p>
                        @endif
                      </div>

                      <div class="field">
                        <div class="control has-icons-left has-icons-right">
                          <input type="password" class="input {{$errors->has('password_confirmation')?'is-danger':''}}" placeholder="New password..." name="new_password">
                          <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                          </span>
                          @if ($errors->has('password_confirmation'))
                            <span class="icon is-small is-right">
                              <i class="fa fa-exclamation-triangle"></i>
                            </span>
                          @endif
                        </div>
                        @if ($errors->has('password_confirmation'))
                          <p class="help is-danger">{{$errors->first('password_confirmation')}}</p>
                        @endif
                      </div>

                      <button type="submit" class="button is-primary is-outlined is-fullwidth m-t-20">Update</button>
                    </form>
                  </div>
                </div> <!--end of .card-->
            </div>
          </div>
        </div>
      </section>

    </Tab>

  @endif
</Profile>

@endsection

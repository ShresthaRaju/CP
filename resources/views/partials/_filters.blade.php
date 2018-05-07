@inject('channels', 'App\Models\Discussion')

<aside class="menu m-l-20 filters">
  @if (Auth::check())
    <a href="{{route('discussion.create')}}" class="button is-info is-rounded is-fullwidth m-b-40">Create Discussion</a>
  @endif

  <p class="menu-label">
    Choose a filter
  </p>
  <ul class="menu-list">
    <li>
      <a href="{{route('welcome')}}" class="{{Request::is('/')?'is-active':''}}">
        <span class="icon filter"><i class="fa fa-globe"></i></span><span>All Threads</span>
      </a>
    </li>
    <li>
      <a href="{{route('popular')}}" class="{{Request::is('discussions/popular')?'is-active':''}}">
        <span class="icon filter"><i class="fa fa-free-code-camp"></i></span><span>All Time Popular</span>
      </a>
    </li>
    <li>
      <a href="{{route('popularThisWeek')}}" class="{{Request::is('discussions/popular-this-week')?'is-active':''}}">
        <span class="icon filter"><i class="fa fa-free-code-camp"></i></span><span>Popular This Week</span>
      </a>
    </li>
    <li>
      <a href="{{route('solved')}}" class="{{Request::is('discussions/solved')?'is-active':''}}">
        <span class="icon filter"><i class="fa fa-thumbs-up"></i></span><span>Solved</span>
      </a>
    </li>
    <li>
      <a href="{{route('unsolved')}}" class="{{Request::is('discussions/unsolved')?'is-active':''}}">
        <span class="icon filter"><i class="fa fa-lightbulb-o"></i></span><span>Unsolved</span>
      </a>
    </li>
    <li>
      <a  href="{{route('leaderboard')}}" class="{{Request::is('discussions/leaderboard')?'is-active':''}}">
        <span class="icon filter"><i class="fa fa-list-ol"></i></span><span>Leaderboard</span>
      </a>
    </li>
  </ul>
</aside>

<div class="has-text-centered m-t-40 m-b-40">
  <p class="title has-text-grey-light">OR</p>
</div>

<aside class="menu m-l-20 filters">
  <p class="menu-label">
    Pick a channel
  </p>
  <ul class="menu-list">
    @foreach ($channels->filters() as $channel)
      <li>
        <a href="{{route('channel',$channel->title)}}" class="{{Request::segment(2)==$channel->title?'is-active':''}}">
          <span class="icon filter"><i class="fa fa-snowflake-o"></i></span><span>{{$channel->title}}</span>
        </a>
      </li>
    @endforeach
  </ul>
</aside>

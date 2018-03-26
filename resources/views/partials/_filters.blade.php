@inject('channels', 'App\Models\Discussion')

<aside class="menu m-l-20 filters">
  @if (Auth::check())
    <a href="{{route('discussion.create')}}" class="button is-info is-fullwidth m-b-40">New Discussion</a>
  @endif

  <p class="menu-label">
    Choose a filter
  </p>
  <ul class="menu-list">
    <li><a href="{{url('/')}}" class="{{Request::is('/')?'is-active':''}}"><span class="icon"><i class="fa fa-globe"></i></span><span>All Threads</span></a></li>
    <li><a><span class="icon"><i class="fa fa-fire"></i></span><span>Popular All Time</span></a></li>
    <li><a><span class="icon"><i class="fa fa-thumbs-up"></i></span><span>Solved</span></a></li>
    <li><a><span class="icon"><i class="fa fa-lightbulb-o"></i></span><span>Unsolved</span></a></li>
    <li><a><span class="icon"><i class="fa fa-list-ol"></i></span><span>LeaderBoard</span></a></li>
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
      <li><a><span class="icon"><i class="fa fa-circle-o-notch"></i></span><span>{{$channel->title}}</span></a></li>
    @endforeach
  </ul>
</aside>

<nav class="navbar has-shadow is-fixed-top">
  <div class="navbar-brand m-r-30">
    <a href="{{route('welcome')}}" class="navbar-item">
      <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
    </a>

    <div class="navbar-burger" id="collapse" onclick="document.getElementById('navMenu').classList.toggle('is-active');">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div> <!--end of navbar-brand-->

  <div class="navbar-menu" id="navMenu">
    <div class="navbar-start">
      <a href="{{route('welcome')}}" class="navbar-item is-tab {{Request::is('/')?'is-active':''}}">Discussions</a>
      <a href="{{route('popular')}}" class="navbar-item is-tab {{Request::is('popular')?'is-active':''}}">Popular</a>
      <a href="#" class="navbar-item is-tab">Leaderboard</a>
    </div>

    <div class="navbar-end">
      @guest
        <div class="navbar-item">
            <div class="field is-grouped">
              <p class="control">
                <a href="{{route('login')}}" class="button is-light"><span class="icon"><i class="fa fa-sign-in"></i></span>Sign In<span></span></a>
              </p>
              <p class="control">
                <a href="{{route('register')}}" class="button is-primary is-outlined"><span class="icon"><i class="fa fa-user-plus"></i></span><span>Join the Discussion</span></a>
              </p>
            </div>
        </div>
      @else
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            Welcome, {{Auth::user()->username}}
          </a>

          <div class="navbar-dropdown is-right">
            <a class="navbar-item" href="{{route('userProfile',auth()->user()->username)}}">
              <span class="icon"><i class="fa fa-user"></i></span><span>Profile</span>
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <span class="icon"><i class="fa fa-sign-out"></i></span><span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
      @endguest
    </div>
  </div> <!-- end of navbar-menu-->
</nav>

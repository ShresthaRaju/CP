<nav class="navbar has-shadow is-transparent is-fixed-top">
  <div class="navbar-brand m-r-30">
    <a class="navbar-item">
      <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
    </a>

    <div class="navbar-burger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div> <!--end of navbar-brand-->

  <div class="navbar-menu">
    <div class="navbar-start">
      <a href="#" class="navbar-item is-tab">Discussions</a>
      <a href="#" class="navbar-item is-tab">Popular</a>
      <a href="#" class="navbar-item is-tab">Leaderboard</a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control">
            <a href="{{route('login')}}" class="button is-dark is-outlined"><span class="icon"><i class="fa fa-sign-in"></i></span>Sign In<span></span></a>
          </p>
          <p class="control">
            <a href="{{route('register')}}" class="button is-info"><span class="icon"><i class="fa fa-user-plus"></i></span><span>Join the Discussion</span></a>
          </p>
        </div>
      </div>
    </div>
  </div> <!-- end of navbar-menu-->
</nav>


{{-- <a class="dropdown-item" href="{{ route('logout') }}"
   onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form> --}}

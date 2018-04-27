<nav class="navbar has-shadow is-fixed-top">
  <div class="navbar-brand m-r-30">

    <div id="sidemenu-drawer-container" class="navbar-item m-r-10">
      <div id="drawer">
          <span></span>
          <span></span>
          <span></span>
      </div>
    </div>

    <a class="navbar-item">
      <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
    </a>

    <div class="navbar-burger" onclick="document.getElementById('nav-menu').classList.toggle('is-active');">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div> <!--end of navbar-brand-->

  <div class="navbar-menu" id="nav-menu">
    <div class="navbar-end">
      <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            Welcome, {{Auth::guard('admin')->check()?Auth::user()->name:''}}
          </a>

          <div class="navbar-dropdown is-right">
            <a class="navbar-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('admin-logout-form').submit();">
                <span class="icon"><i class="fa fa-sign-out"></i></span><span>Logout</span>
            </a>

            <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
    </div>
  </div> <!-- end of navbar-menu-->
</nav>

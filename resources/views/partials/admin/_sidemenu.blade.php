<div id="side-menu">
  <aside class="menu m-t-10 m-l-20">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li>
        <a href="{{route('admin.dashboard')}}" class="{{Request::is('admin/dashboard')?'is-active':''}}">
        <span class="icon filter"><i class="fa fa-dashboard"></i></span><span>Dashboard</span>
      </a>
    </li>
    </ul>
    <p class="menu-label">
      Administration
    </p>
    <ul class="menu-list">
      <li>
        <a href="{{route('admin.users.index')}}" class="{{Request::is('admin/users')?'is-active':''}}">
          <span class="icon filter"><i class="fa fa-users"></i></span><span>Users</span>
        </a>
      </li>

      <li>
        <a href="{{route('admin.channels.index')}}" class="{{Request::is('admin/channels')?'is-active':''}}">
          <span class="icon filter"><i class="fa fa-snowflake-o"></i></span><span>Channels</span>
        </a>
      </li>

      <li>
        <a href="{{route('admin.discussions.index')}}" class="{{Request::is('admin/discussions')?'is-active':''}}">
          <span class="icon filter"><i class="fa fa-sticky-note"></i></span><span>Discussions</span>
        </a>
      </li>

    </ul>
  </aside>
</div>

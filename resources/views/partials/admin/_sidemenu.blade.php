<div id="side-menu">
  <aside class="menu m-t-10 m-l-20">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li><a href="{{route('admin.dashboard')}}"><span class="icon"><i class="fa fa-dashboard"></i></span><span>Dashboard</span></a></li>
    </ul>
    <p class="menu-label">
      Administration
    </p>
    <ul class="menu-list">
      <li>
        <a class="is-active"><span class="icon"><i class="fa fa-users"></i></span><span>Users</span></a>
        <ul>
          <li><a href="{{route('admin.users.index')}}"><span class="icon"><i class="fa fa-th-list"></i></span><span>List</span></a></li>
          <li><a href="{{route('admin.users.create')}}"><span class="icon"><i class="fa fa-plus"></i></span><span>Add</span></a></li>
        </ul>
      </li>
      <li>
        <a><span class="icon"><i class="fa fa-sticky-note"></i></span><span>Discussions</span></a>
        <ul>
          <li><a href=""><span class="icon"><i class="fa fa-th-list"></i></span><span>List</span></a></li>
          <li><a href=""><span class="icon"><i class="fa fa-plus"></i></span><span>Add</span></a></li>
        </ul>
      </li>
      <li>
        <a><span class="icon"><i class="fa fa-circle-o-notch"></i></span><span>Channels</span></a>
        <ul>
          <li><a href=""><span class="icon"><i class="fa fa-th-list"></i></span><span>List</span></a></li>
          <li><a href=""><span class="icon"><i class="fa fa-plus"></i></span><span>Add</span></a></li>
        </ul>
      </li>
    </ul>
  </aside>
</div>

<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu" data-plugin="menu">
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
            </a>
          </li>
           
            @can('user_access')
            <li class="site-menu-item {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
              <a class="animsition-link" href="{{ route("admin.users.index") }}">
                <span class="site-menu-title">Users</span>
              </a>
            </li>
            @endcan
        </ul>
      </div>
    </div>
  </div>
</div>
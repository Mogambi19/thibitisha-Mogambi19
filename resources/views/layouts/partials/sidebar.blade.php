<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
  <div class="sidebar-brand">
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('favicon.png') }}" alt="{{ env('APP_NAME', 'Thibitisha') }} Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text waterfall-regular fs-3">{{ env('APP_NAME', 'Thibitisha') }}</span>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link{{ request()->is('/') ? ' active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">User Management</li>
        <li class="nav-item">
          <a href="{{ route('roles.index') }}" class="nav-link{{ request()->is('roles*') ? ' active' : '' }}">
            <i class="nav-icon bi bi-shield-lock"></i>
            <p>Roles</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-people"></i>
            <p>Users</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar-->

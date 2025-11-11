<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="{{ URL::to('/') }}" class="brand-link">
      <img src="{{ asset('adminlte/assets/img/thibitisha.png') }}" alt="Thibitisha Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text fw-light">Thibitisha</span>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false">
        <li class="nav-item">
          <a href="{{ URL::to('/') }}" class="nav-link active">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">User Management</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-shield-lock"></i>
            <p>
              Roles
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>All Roles</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ URL::to('role/add') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Add Role</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-people"></i>
            <p>Users</p>
          </a>
        </li>
        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-gear"></i>
            <p>System Settings</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar-->

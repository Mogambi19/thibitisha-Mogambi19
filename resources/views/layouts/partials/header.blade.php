<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body" data-bs-theme="dark">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <img src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User Image" />
          <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'Guest' }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <li class="user-header text-bg-secondary">
            <img src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User Image" />
            <p>
              <small>Member since 2024</small>
            </p>
          </li>
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
            <form action="#" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<!--end::Header-->

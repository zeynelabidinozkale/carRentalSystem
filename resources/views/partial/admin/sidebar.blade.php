
      <nav class="col-md-2 d-none d-md-block bg-light sidebar mt-4" id="nav">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.index',['role'=>'client']) }}">
                <span data-feather="users"></span>
                Clients
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index',['role'=>'staff']) }}">
                  <span data-feather="user-plus"></span>
                  Staff
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index',['role'=>'admin']) }}">
                  <span data-feather="user-check"></span>
                  Admins
                </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>System</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Logs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Settings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Logout
              </a>
            </li>
          </ul>
        </div>
      </nav>

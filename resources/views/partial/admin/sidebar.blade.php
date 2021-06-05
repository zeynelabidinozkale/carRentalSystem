
      <nav class="col-md-2 d-none d-md-block bg-light sidebar mt-4 p-1" id="nav">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            @if(auth()->user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reservation.index') }}">
                    <span data-feather="server"></span>
                    Reservations
                </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                <span>User Management</span>
                <a class="d-flex align-items-center text-muted" href="#">
                  <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                  <span data-feather="users"></span>
                  All Users
                </a>
            </li>
            @foreach (\App\Models\Role::all() as $role)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index',['role'=>$role->name]) }}">
                  <span data-feather="users"></span>
                  {{ucfirst($role->name)}}s
                </a>
            </li>
            @endforeach

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                <span>Vehicle Fleet</span>
                <a class="d-flex align-items-center text-muted" href="#">
                  <span data-feather="plus-circle"></span>
                </a>
            </h6>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vehicle.index') }}">
                        <span data-feather="clipboard"></span>
                        Vehicles
                    </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('fueltype.index') }}">
                    <span data-feather="server"></span>
                    Fuel Types
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('geartype.index') }}">
                      <span data-feather="server"></span>
                      Gear Types
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vclass.index') }}">
                        <span data-feather="server"></span>
                        Vehicle Classes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('office.index') }}">
                        <span data-feather="map-pin"></span>
                        Offices
                    </a>
                </li>
              </ul>
              @else
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                <span>Reservations</span>
                <a class="d-flex align-items-center text-muted" href="#">
                  <span data-feather="plus-circle"></span>
                </a>
            </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('office.index') }}">
                            <span data-feather="server"></span>
                            Offices
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reservation.index') }}">
                            <span data-feather="server"></span>
                            Reservations
                        </a>
                    </li>
                </ul>
              @endif
            {{-- <li class="nav-item">
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
            </li> --}}
          </ul>
          @if(auth()->user()->hasRole('admin'))
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>System</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logs') }}">
                <span data-feather="server"></span>
                Logs
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('role.index') }}">
                  <span data-feather="tool"></span>
                  Roles
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.edit',['user'=>auth()->user()]) }}">
                <span data-feather="settings"></span>
                Account
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span data-feather="file-text"></span>
                Logout
              </a>
            </li>
          </ul>
          @else
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Account</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.edit',['user'=>auth()->user()]) }}">
                <span data-feather="settings"></span>
                Account
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span data-feather="file-text"></span>
                Logout
              </a>
            </li>
          </ul>
          @endif
        </div>
      </nav>

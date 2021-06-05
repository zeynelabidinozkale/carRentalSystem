<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('dashboard') }}"> <img src="{{asset('/assets/brand/logo.svg')}}" class="translate-logo" height="32"> {{ config('app.name', 'Laravel') }} </a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 ml-5 mt-lg-0 menu-md ">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('home') }}" target="_blank"> <span data-feather="corner-up-left"></span> Go To Site <span class="sr-only">(current)</span></a>
        </li>
    </ul>
      <ul class="navbar-nav mr-auto mt-2 ml-5 mt-lg-0 menu-sm">
        <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            @if(auth()->user()->hasRole('admin'))
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Vehicle Fleet</span>
                <a class="d-flex align-items-center text-muted" href="#">
                  <span data-feather="plus-circle"></span>
                </a>
            </h6>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vehicle.index') }}">
                        <span data-feather="server"></span>
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
                        <span data-feather="server"></span>
                        Offices
                    </a>
                </li>
              </ul>
              @else
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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
      </ul>
      <ul class="m-0 pl-0 list-style-none" >
        @guest
            <li class="nav-item dropdown maker-none">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Auth
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if (Route::has('login')) <button class="dropdown-item hover-pointer" type="button" onclick="window.location.href = '{{ route('login') }}'">login</button>@endif
                        @if (Route::has('register'))<button class="dropdown-item hover-pointer" type="button" onclick="window.location.href = '{{ route('register') }}'">Register</button>@endif
                    </div>
                </div>
            </li>
            @else
            <li class="nav-item dropdown maker-none">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item hover-pointer" type="button" onclick="window.location.href = '{{ route('user.edit',['user'=>auth()->user()]) }}'">Account</button>
                        <button class="dropdown-item hover-pointer" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>
                    </div>
                </div>
                <form autocomplete="off" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
    </div>
  </nav>

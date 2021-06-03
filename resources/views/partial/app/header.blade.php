<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mr-1" href="{{ route('home') }}"> <img src="/assets/brand/logo.svg" class="translate-logo" height="32"> {{ config('app.name', 'Laravel') }} </a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 ml-5 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('home') }}" > <span data-feather="home"></span> Home </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="" > <span data-feather="award"></span> About </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="" > <i class="fa fa-car-side fa-xl"></i> Vehicles </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="" > <span data-feather="map-pin"></span> Our Offices </a>
        </li>
        @auth
        @if(auth()->user()->role->panelLogin)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}" > <span data-feather="user"></span> Dashboard </a>
        </li>
        @else
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('account.index') }}" > <span data-feather="user"></span> My Account </a>
        </li>
        @endif
        @else
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('account.index') }}" > <span data-feather="user"></span> My Account </a>
        </li>
        @endauth
      </ul>
      <ul class="m-0 list-style-none maker-none" >
        @guest
            <li class="nav-item dropdown ">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My account
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
                        <button class="dropdown-item hover-pointer" type="button" onclick="location.href = '@if(auth()->user()->role->panelLogin) {{ route('user.edit',auth()->user()) }} @else {{ route('account.index') }} @endif'">My account</button>
                        @if(auth()->user()->role->panelLogin) <button class="dropdown-item hover-pointer" type="button"  onclick="location.href = '{{ route('dashboard') }}'">Dashboard</button> @else <button class="dropdown-item hover-pointer" type="button"  onclick="location.href = '{{ route('account.reservations') }}'">Reservations</button> @endif
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

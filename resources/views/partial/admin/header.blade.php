<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('dashboard') }}"> <img src="/assets/brand/logo.svg" class="translate-logo" height="32"> {{ config('app.name', 'Laravel') }} </a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 ml-5 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('home') }}" target="_blank"> <span data-feather="corner-up-left"></span> Go To Site <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <ul class="m-0 list-style-none" >
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

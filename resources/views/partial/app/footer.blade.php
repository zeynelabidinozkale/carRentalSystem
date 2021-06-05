<div class="bg-dark">

    <footer class="container">
        <div class="row pt-5 pb-5">
        <div class="col-12 col-md ">
            <img class="mb-2" src="{{asset('/assets/brand/logo.svg')}}" alt="" width="100" height="100">
            <small class="d-block mb-3 text-muted">© {{date('Y')}} {{env('APP_NAME')}}</small>
        </div>
        <div class="col-6 col-md">
            <h5 class="text-light">Pages</h5>
            <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="{{ route('home') }}">Home</a></li>
            <li><a class="text-muted" href="{{ route('about') }}">About</a></li>
            <li><a class="text-muted" href="{{ route('vehicles') }}">Vehicles</a></li>
            <li><a class="text-muted" href="{{ route('offices') }}">Our Offices</a></li>
            <li><a class="text-muted" href="{{ route('about') }}">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5 class="text-light">Reservations</h5>
            <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="{{ route('home.reservation',['step'=>'reservation']) }}">Start Reservation</a></li>
            <li><a class="text-muted" href="{{ route('account.reservations') }}">My Reservations</a></li>
            <li><a class="text-muted" href="{{ route('home.reservation.track') }}">Tracking Reservation Records</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5 class="text-light">Account</h5>
            <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="{{ route('account.index') }}">My Account</a></li>
            @if(Auth::check())
            <li><a class="text-muted" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            @else
            <li><a class="text-muted" href="{{ route('login') }}">Login</a></li>
            <li><a class="text-muted" href="{{ route('register') }}">Register</a></li>
            @endif
            </ul>
        </div>
        </div>
    </footer>

</div>
<form autocomplete="off" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>

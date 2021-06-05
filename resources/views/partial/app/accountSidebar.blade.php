<div class="card vehicleFilterCard">
    <div class="card-header d-flex justify-space-between">
        <h4 class="mb-0 text-center"><span data-feather="user"></span> Account Menu </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 bb-1 pt-1 pb-1">
                        <a href="{{ route('account.index') }}" class="menu-item text-dark">My Account</a>
                    </div>
                    <div class="col-12 bb-1 pt-1 pb-1">
                        <a href="{{ route('account.reservations') }}" class="menu-item text-dark">Reservations</a>
                    </div>
                    <div class="col-12 bb-1 pt-1 pb-1">
                        <a href="{{ route('home.reservation.track') }}" class="menu-item text-dark">Track Reservation</a>
                    </div>
                    <div class="col-12 pt-1 pb-1">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="menu-item text-dark">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form autocomplete="off" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

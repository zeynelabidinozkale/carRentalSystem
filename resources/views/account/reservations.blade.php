@extends('layouts.app')
@section('content')

<section class="mt-5 mb-100">
    <div class="container mb-5">
        <div class="row" >
            <div class="col-md-3">
                @include('partial.app.accountSidebar')
            </div>
            <div class="col-md-9">
                @if(auth()->user()->reservations->count()>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                      <thead>
                        <tr>
                          <th>Vehicle</th>
                          <th>Pick Up Office</th>
                          <th>Drop Off Office</th>
                          <th>Reservation Date</th>
                          <th>Pick Up Date</th>
                          <th>Drop Off Date</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach(auth()->user()->reservations as $reservation)
                          <tr>
                            <td> @if($reservation->vehicle->image) <img src="{{ Storage::url($reservation->vehicle->image)}}" width="100"> <br> @endif {{ $reservation->vehicle->name }}</td>
                            <td>{{ @$reservation->pickUpOffice->name }}</td>
                            <td>{{ @$reservation->dropOffOffice->name }}</td>
                            <td>{{ $reservation->created_at }}</td>
                            <td>{{ $reservation->reservation_pick_up_datetime }}</td>
                            <td>{{ $reservation->reservation_drop_off_datetime }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm mr-1" href="{{route('account.reservationDetails',['id'=>$reservation->id])}}">View Details</a>
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                @else
                  <div class="alert alert-warning"> You do not have a reservation yet </div>
                @endif



                {{-- <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('home.reservation.checkout') }}" >
                    @csrf
                    <input type="hidden" name="step" value="checkout">
                    <input type="hidden" name="reservation[vehicle_id]" value="{{ @$request['vehicle_id'] }}">
                    <input type="hidden" name="reservation[pick_up_office_id]" value="{{ @$request['pick_up_office_id'] }}">
                    <input type="hidden" name="reservation[drop_off_office_id]" value="{{ @$request['drop_off_office_id'] }}">
                    <input type="hidden" name="reservation[reservation_pick_up_datetime]" value="{{ @\Carbon\Carbon::parse($request->reservation_pick_up_datetime)->format('Y-m-d H:i:s') }}">
                    <input type="hidden" name="reservation[reservation_drop_off_datetime]" value="{{ @\Carbon\Carbon::parse($request->reservation_drop_off_datetime)->format('Y-m-d H:i:s') }}">
                    <input type="hidden" name="reservation[days]" value="{{ \Carbon\Carbon::parse($request->reservation_pick_up_datetime)->diff(\Carbon\Carbon::parse($request->reservation_drop_off_datetime))->days }}">
                    @if(Auth::check())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                You are logged in as <b>{{ auth()->user()->name }}</b>. You can review your reservations from your control panel after you complete your reservation.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="reservation[client_id]" value="{{ auth()->user()->id }}">
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info"> <b><a href="{{ route('login') }}" class="text-dark">Login</a></b> or <b><a href="{{ route('register') }}" class="text-dark">register</a></b> if you are not registered to complete the reservation process easily. <br> <small class="text-dark">(You will be redirected to this page when you log in)</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="bb-1">User Information</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Name Surname</label>
                            <input type="text" class="form-control" name="user[name]" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">TC/Passport Number</label>
                            <input type="number" class="form-control" name="user[tcPassportNo]" maxlength="20" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="user[email]" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tel">Tel</label>
                            <input type="text" class="form-control" name="user[tel]" maxlength="20" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="checkbox" id="completeSubscription" name="completeSubscription">
                            <label for="completeSubscription" class="mb-0">Complete my subscription. (We will send your password to your email address.)</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="user[address]" rows="2" ></textarea>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="bb-1">Billing Information</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Name</label>
                            <input type="text" class="form-control" name="billingInformation[name]" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Surname</label>
                            <input type="text" class="form-control" name="billingInformation[surname]" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">TC/Passport Number</label>
                            <input type="text" class="form-control" name="billingInformation[tcPassportNo]" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Company Name</label>
                            <input type="text" class="form-control" name="billingInformation[companyName]" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Tax No</label>
                            <input type="text" class="form-control" name="billingInformation[taxNo]" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Tax Administration</label>
                            <input type="text" class="form-control" name="billingInformation[TaxAdministration]" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="billingInformation[address]" rows="2" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="checkbox" id="kvkk" name="kvkk" required>
                            <label class="mb-0">I have read and accept the <b class="hover-pointer" data-toggle="modal" data-target="#kvkkModal">KVKK Clarification Text</b>.</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="checkbox" id="rentalAgreement" name="rentalAgreement"  required>
                            <label class="mb-0">I have read and accept the <b class="hover-pointer" data-toggle="modal" data-target="#rentalAgreementModal">Rental Agreement</b>.</label>
                        </div>
                        <div class="col-md-12 mb-3 text-right">
                            <button class="btn btn-success" type="submit" >Proceed to Checkout</button>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>

    </div>
</section>


@endsection

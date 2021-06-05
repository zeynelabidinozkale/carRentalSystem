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
                            <td> @if($reservation->vehicle->image) <img src="{{ asset(Storage::url($reservation->vehicle->image))}}" width="100"> <br> @endif {{ $reservation->vehicle->name }}</td>
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

 
            </div>
        </div>

    </div>
</section>


@endsection

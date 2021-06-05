@extends('layouts.admin')

@section('content')
        <div class="d-flex justify-space-between">
            <h2>Reservations</h2>
            <div class="d-inline">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('trackNumber') }}" name="trackNumber" placeholder="Tracking Number">
                        <div class="input-group-append">
                            <button class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="dropdown align-self-center">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter Reservations @isset($request->mode)({{$request->mode}})@endisset
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('reservation.index') }}">All</a>
                    <a class="dropdown-item" href="{{ route('reservation.index',['mode'=>'newReservations']) }}">New Reservations</a>
                    <a class="dropdown-item" href="{{ route('reservation.index',['mode'=>'futureReservations']) }}">Future Reservations</a>
                    <a class="dropdown-item" href="{{ route('reservation.index',['mode'=>'previousReservations']) }}">Previous Reservations</a>
                </div>
            </div>
        </div>

        <div class="col-md-8"></div>
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
                <th>Status</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td> @if($reservation->vehicle->image) <img src="{{ asset(Storage::url($reservation->vehicle->image))}}" width="100"> <br> @endif {{ $reservation->vehicle->name }}</td>
                    <td>{{ @$reservation->pickUpOffice->name }}</td>
                    <td>{{ @$reservation->dropOffOffice->name }}</td>
                    <td>{{ $reservation->created_at }}</td>
                    <td>{{ $reservation->reservation_pick_up_datetime }}</td>
                    <td>{{ $reservation->reservation_drop_off_datetime }}</td>
                    <td>
                        @switch($reservation->status)
                            @case('pending')
                                <span class="badge badge-warning badge-lg">{{ $reservation->status }}</span>
                                @break
                            @case('paid')
                                <span class="badge badge-success badge-lg">{{ $reservation->status }}</span>
                                @break
                            @case('canceled')
                                <span class="badge badge-danger badge-lg">{{ $reservation->status }}</span>
                                @break
                            @default
                        @endswitch
                    </td>
                    <td>
                    <a class="btn btn-primary btn-sm mr-1" href="{{route('reservation.edit',$reservation->id)}}">Edit</a>
                    <form autocomplete="off" class="delete d-inline" action="{{route('reservation.destroy',$reservation->id)}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE"> {{csrf_field()}} <button class="btn btn-danger btn-sm mr-1 confirmation" type="submit">Delete</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            {{ $reservations->links() }}
        </div>
@endsection

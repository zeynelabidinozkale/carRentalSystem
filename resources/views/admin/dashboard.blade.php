@extends('layouts.admin')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-12">
        <div class="row">
            @if(auth()->user()->hasRole('admin'))
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-primary mb-3 hover-pointer" onclick="location.href='{{ route('vehicle.index') }}'" >
                    <div class="card-body">
                      <h5 class="card-title">VEHICLES ({{ \App\Models\Vehicle::count() }})</h5>
                      <p class="card-text">Click here to go to manage vehicles page.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-success mb-3 hover-pointer" onclick="location.href='{{ route('office.index') }}'" >
                    <div class="card-body">
                      <h5 class="card-title">ALL OFFICES ({{ \App\Models\Office::count() }})</h5>
                      <p class="card-text">Click here to go to manage offices page.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-danger mb-3 hover-pointer" onclick="location.href='{{ route('user.index',['role'=>'client']) }}'" >
                    <div class="card-body">
                      <h5 class="card-title">CLIENTS ({{ \App\Models\User::whereHas('role',function($u){ $u->where('name','client'); })->count() }})</h5>
                      <p class="card-text">Click here to go to manage clients page.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-dark mb-3 hover-pointer" onclick="location.href='{{ route('reservation.index') }}'" >
                    <div class="card-body">
                      <h5 class="card-title">Reservations ({{ \App\Models\Reservation::count() }})</h5>
                      <p class="card-text">Click here to go to manage reservations page.</p>
                    </div>
                </div>
            </div>
            @else

            @php
                $user = auth()->user();

                $offices = auth()->user()->offices;
                $reservations = \App\Models\Reservation::whereIn('pick_up_office_id',$offices->pluck('id'));

            @endphp
                <div class="col-md-6">
                    <div class="card text-white bg-success mb-3 hover-pointer" onclick="location.href='{{ route('office.index') }}'" >
                        <div class="card-body">
                          <h5 class="card-title">OFFICES ({{ $offices->count() }})</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-white bg-dark mb-3 hover-pointer" onclick="location.href='{{ route('reservation.index') }}'" >
                        <div class="card-body">
                          <h5 class="card-title">Reservations ({{ $reservations->count() }})</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 table-resonsive">
                @if($reservations->count()>0)
                <div class="alert alert-warning">There are <b>{{$reservations->count()}}</b> new reservations</div>
                    <table class="table table-striped table-hover table-sm table-resonsive">
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
                                <td> @if($reservation->vehicle->image) <img src="{{ Storage::url($reservation->vehicle->image)}}" width="100"> <br> @endif {{ $reservation->vehicle->name }}</td>
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
                @else
                    <div class="alert alert-warning">There are no new reservations</div>
                @endif
            </div>
        </div>
    </div>
@endsection

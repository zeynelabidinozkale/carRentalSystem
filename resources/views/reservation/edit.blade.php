@extends('layouts.admin')

@section('content')
        <div class="d-flex justify-space-between d-block-sm d-flex-sm">
            <h2> Reservation / Edit </h2>
            <form class="d-flex" autocomplete="off" class="needs-validation" method="POST" action="{{ route('reservation.update',$reservation) }}" >
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                @if($reservation->drop_off_datetime < \Carbon\Carbon::now() && !$reservation->pick_up_datetime)
                <button type="submit" @if(!$reservation->canceled_at) name="event" value="cancelReservation" @endif class="btn btn-danger align-self-center mr-2 mb-1 confirmation" @if($reservation->canceled_at) disabled @endif> @if($reservation->canceled_at) Canceled at {{ $reservation->canceled_at }} @else Cancel Reseration @endif </button>
                @endif
                @if(!$reservation->canceled_at)
                <button type="submit" @if(!$reservation->pick_up_datetime) name="event" value="costumerReceivedTheVehicle" @endif class="btn btn-primary align-self-center mr-2 mb-1 confirmation" @if($reservation->pick_up_datetime) disabled @endif> @if($reservation->pick_up_datetime) customer received at {{ $reservation->pick_up_datetime }} @else customer received the vehicle @endif </button>
                <button type="submit" @if(!$reservation->drop_off_datetime) name="event" value="costumerDeliveredTheVehicle" @endif class="btn btn-success align-self-center mb-1 confirmation" @if($reservation->drop_off_datetime) disabled @endif> @if($reservation->drop_off_datetime) customer delivered at {{ $reservation->drop_off_datetime }} @else customer delivered the vehicle @endif </button>
                @endif
            </form>
        </div>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-12">
                    <div class="card mb-5">
                       <div class="card-header">
                          Invoice
                          <span><strong>Reservation Date: </strong> {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }} - <strong>Time:</strong> {{ \Carbon\Carbon::parse($reservation->created_at)->format('H:i') }}</span>
                          <span class="float-right"> <strong>Status:</strong> {{ $reservation->status }}</span>
                       </div>
                       <div class="card-body">
                          <div class="row mb-4">
                             <div class="col-sm-6">
                                <h6 class="mb-3">From:</h6>
                                <div>
                                   <strong>Car Rental System</strong>
                                </div>
                                <div>Lorem Ipsum</div>
                                <div>71-101 Istanbul, Turkey</div>
                                <div>Email: info@carrentalsystem.com.tr</div>
                                <div>Phone: +90 444 666 111</div>
                             </div>
                             <div class="col-sm-6">
                                <h6 class="mb-3">To:</h6>
                                <div>
                                   <strong>Client {{ $reservation->billingInformation->name ? $reservation->billingInformation->name: "" }} {{ $reservation->billingInformation->companyName ? $reservation->billingInformation->companyName : "" }} </strong>
                                </div>
                                <div>Name: {{ $reservation->client->name }} </div>
                                <div>{{$reservation->billingInformation->address}}</div>
                                <div>Email: {{$reservation->client->email}}</div>
                                <div>Phone: {{$reservation->client->tel}}</div>
                             </div>
                          </div>
                          <div class="table-responsive-sm">
                             <table class="table table-striped">
                                <thead>
                                   <tr>
                                      <th class="center">#</th>
                                      <th>Item</th>
                                      <th>Description</th>
                                      <th class="right">Unit Cost</th>
                                      <th class="center">Deposit</th>
                                      <th class="center">Qty (Days) </th>
                                      <th class="right">Total</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $vehicle = \App\Models\Office::find($reservation->pick_up_office_id)->vehicles()->find($reservation->vehicle_id);
                                    @endphp
                                   <tr>
                                      <td class="center">1</td>
                                      <td class="left strong"> @if($vehicle->image) <img src="{{ Storage::url($vehicle->image) }}" width="100"> <br> @endif {{ $vehicle->name }} ({{ $vehicle->vclass->name }})</td>
                                      <td class="left"> {{ $vehicle->seats }} seats, {{ $vehicle->bags }} bags, {{ $vehicle->doors }} doors <br> <b>fuel type:</b> {{ $vehicle->fueltype->name }}, <b>gear type:</b> {{ $vehicle->geartype->name }}, <b>Vehicle Class:</b> {{ $vehicle->vclass->name }} <br>
                                        <b>Pick Up:</b> {{ \Carbon\Carbon::parse($reservation->reservation_pick_up_datetime)->format('d/m/Y H:i') }} - {{ @$reservation->pickUpOffice->name }} <br>
                                        <b>Drop Off:</b> {{ \Carbon\Carbon::parse($reservation->reservation_drop_off_datetime)->format('d/m/Y H:i') }} - {{ @$reservation->dropOffOffice ? @$reservation->dropOffOffice->name : @$reservation->pickUpOffice->name  }} <br>
                                        </td>
                                      <td class="right">₺{{ $vehicle->pivot->cost }} </td>
                                      <td class="center">₺{{ $vehicle->pivot->deposit }}</td>
                                      <td class="center">{{ $reservation->days }}</td>
                                      <td class="right">₺{{ $reservation->total }}</td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                          <div class="row">
                             <div class="col-lg-4 col-sm-5">
                             </div>
                             <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                   <tbody>
                                      <tr>
                                         <td class="left">
                                            <strong>Subtotal</strong>
                                         </td>
                                         <td class="right">₺{{bcmul($vehicle->pivot->cost, $reservation->days, 2) }} </td>
                                      </tr>
                                      <tr>
                                        <td class="left">
                                           <strong>KDV</strong>
                                        </td>
                                        <td class="right">₺{{bcmul(bcmul($vehicle->pivot->cost, $reservation->days, 2),'0.18',2)}} </td>
                                     </tr>
                                     <tr>
                                        <td class="left">
                                           <strong>Deposit</strong>
                                        </td>
                                        <td class="right">₺{{ $vehicle->pivot->deposit }} </td>
                                     </tr>
                                      <tr>
                                         <td class="left">
                                            <strong>Total</strong>
                                         </td>
                                         <td class="right">
                                            <strong> ₺{{ $reservation->toPay }} </strong>
                                         </td>
                                      </tr>
                                   </tbody>
                                </table>
                             </div>
                          </div>
                       </div>
                    </div>
            </div>
        </div>
@endsection

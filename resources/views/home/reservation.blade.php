


@extends('layouts.app')
@section('content')
<section class="mt-5 hidden-xs">
    <div class="container">
        <div class="row pt-2">
            <div class="col-sm-4 text-center reservation-steps active">
              <span class="far fa-calendar reservation-steps-icon"></span>
              <h3>Reservation</h3>
              <p></p>
              <span class="reservation-steps-line"></span>
            </div><!-- /.col-lg-4 -->
            <div class="col-sm-4 text-center reservation-steps @if($request->step == 'vehicle' || $request->step == 'checkout') active @endif">
                <i class="fa fa-car reservation-steps-icon"></i>
              <h3>Choose Vehicle</h3>
              <p></p>
              <span class="reservation-steps-line"></span>
            </div><!-- /.col-lg-4 -->
            <div class="col-sm-4 text-center reservation-steps @if($request->step == 'checkout') active @endif">
                <span class="far fa-edit reservation-steps-icon"></span>
              <h3>Checkout</h3>
              <p></p>
            </div>
        </div>
    </div>
</section>

<section class="mt-5 mb-100">
    <div class="container mb-5">
        @switch($request->step)
            @case('reservation')
            <div class="card shadow-lg mb-5" >
                <div class="card-header text-center">
                    <h5>Reservation Rorm</h5>
                </div>
                <div class="card-body">
                    <form autocomplete="off" class="row" action="{{ route('home.reservation') }}" >
                        <input type="hidden" name="step" value="vehicle">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pick_up_office_id">Select pickup location</label>
                                <select class="select2 form-control" name="pick_up_office_id" required>
                                    <option value="">---</option>
                                    @foreach ($offices as $office)
                                    <option value="{{ $office->id }}" > {{$office->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="drop_off_office_id"><input type='checkbox' name="select_drop_off_office_id" value="select_drop_off_office_id" data-toggle='collapse' data-target='#returnLocation'> Select Return location</label>
                                <div id="returnLocation" class="collapse w-100">
                                    <select class="select2 form-control" name="drop_off_office_id">
                                        <option value="">---</option>
                                        @foreach ($offices as $office)
                                        <option value="{{ $office->id }}" > {{$office->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date-range200">Select pickup and Return Date</label> <br>
                                <span id="two-inputs"><input class="datetimeInput" name="reservation_pick_up_datetime" id="date-range200" size="20" value="" required> to <input class="datetimeInput" name="reservation_drop_off_datetime" id="date-range201" size="20" value="" required></span>
                            </div>
                            <div class="form-group">
                                <label for=""></label>
                                <button class="btn btn-success btn-block" >Continue to Reservation <span data-feather="chevron-right"></span> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @break
            @case('vehicle')
            <div class="row" >
                <div class="col-md-4">
                    <div class="card vehicleFilterCard">
                        <div class="card-header d-flex justify-space-between">
                            <h4 class="mb-0 text-center"><span data-feather="filter"></span> Filters </h4>
                            @if($request->vclass || $request->geartype || $request->fueltype) <a id="clearFilter" class="text-danger hover-pointer"> <span data-feather="x"></span><u>Clear Filters</u> </a> @endif
                        </div>
                        <div class="card-body">
                            <form id="vehicleFilterForm" action="">
                                <input type="hidden" name="step"  value="vehicle">
                                <input type="hidden" name="pick_up_office_id" value="{{ @$request['pick_up_office_id'] }}">
                                <input type="hidden" name="drop_off_office_id" value="{{ @$request['drop_off_office_id'] ? $request['drop_off_office_id'] : $request['pick_up_office_id'] }}">
                                <input type="hidden" name="reservation_pick_up_datetime" value="{{ @$request['reservation_pick_up_datetime'] }}">
                                <input type="hidden" name="reservation_drop_off_datetime" value="{{ @$request['reservation_drop_off_datetime'] }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-12 bb-1">
                                                <h5>Vehicle Class</h5>
                                            </div>
                                            @foreach ($vclasses as $vclass)
                                            <div class="form-inline rounded p-sm-2 col-6 mt-1"> <input type="checkbox" name="vclass[]" value="{{ $vclass->id }}" id="vclass-{{ $vclass->id }}" @if(@in_array($vclass->id,$request->vclass)) checked @endif> <label for="vclass-{{ $vclass->id }}" class="pl-1 pt-sm-0 pt-1">{{ $vclass->name }}</label> </div>
                                            @endforeach
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 bb-1">
                                                <h5>Gear Type</h5>
                                            </div>
                                            @foreach ($geartypes as $geartype)
                                            <div class="form-inline rounded p-sm-2 col-6 mt-1"> <input type="checkbox" name="geartype[]" value="{{ $geartype->id }}" id="geartype-{{ $geartype->id }}" @if(@in_array($geartype->id,$request->geartype)) checked @endif> <label for="geartype-{{ $geartype->id }}" class="pl-1 pt-sm-0 pt-1">{{ $geartype->name }}</label> </div>
                                            @endforeach
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 bb-1">
                                                <h5>Fuel Type</h5>
                                            </div>
                                            @foreach ($fueltypes as $fueltype)
                                            <div class="form-inline rounded p-sm-2 col-6 mt-1"> <input type="checkbox" name="fueltype[]" value="{{ $fueltype->id }}" id="fueltype-{{ $fueltype->id }}" @if(@in_array($fueltype->id,$request->fueltype)) checked @endif> <label for="fueltype-{{ $fueltype->id }}" class="pl-1 pt-sm-0 pt-1">{{ $fueltype->name }}</label> </div>
                                            @endforeach
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 ">
                                                <button type="submit" class="btn btn-success btn-block"> <b>Filter</b>  <span data-feather="chevron-right"></span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="">
                        <input type="hidden" name="step"  value="checkout">
                        <input type="hidden" name="pick_up_office_id" value="{{ @$request['pick_up_office_id'] }}">
                        <input type="hidden" name="drop_off_office_id" value="{{ @$request['drop_off_office_id'] }}">
                        <input type="hidden" name="reservation_pick_up_datetime" value="{{ @$request['reservation_pick_up_datetime'] }}">
                        <input type="hidden" name="reservation_drop_off_datetime" value="{{ @$request['reservation_drop_off_datetime'] }}">
                        @if($vehicles->count()>0)
                        <div class="alert bg-light b-1"> <b>{{$vehicles->count()}}</b> vehicles found. </div>
                        @foreach ($vehicles as $vehicle)
                        <div class="card flex-md-row mb-4 box-shadow h-md-280x280 display-sm-block">
                            <img class="card-img-right flex-auto" src="@if($vehicle->image) {{ Storage::url($vehicle->image) }} @else /img/noImage/noImage.png @endif" style="width:280px;height:280px;" >
                            <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block mb-2 text-primary"> {{ @$vehicle->vclass->name }} - {{@$vehicle->fueltype->name}} - {{ @$vehicle->geartype->name }}</strong>
                                <h3 class="mb-0">
                                <span class="text-dark" href="#">{{$vehicle->name}}</span>
                                </h3>
                                <table class="table mt-2 mb-0">
                                    <thead>
                                        <tr class="bt-0 text-center">
                                            <th class=" border">
                                                <span data-feather="users"></span>
                                            </th>
                                            <th class=" border">
                                                <span data-feather="square"></span>
                                            </th>
                                            <th class=" border">
                                                <span data-feather="briefcase"></span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr class="bt-0 text-center">
                                            <td class=" border">
                                                {{ $vehicle->seats }} seats
                                            </td>
                                            <td class=" border">
                                                {{ $vehicle->doors }} doors
                                            </td>
                                            <td class=" border">
                                                {{ $vehicle->bags }} bags
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table mb-0">
                                    <tbody >
                                        <tr class="bt-0 text-center">
                                            <td class="p-0 border w-50">
                                                <span class="btn btn-block btn-light"> ₺ {{ $vehicle->pivot->cost }} </span>
                                            </td>
                                            <td class="p-0 border w-50">
                                                <button name="vehicle_id" value="{{ $vehicle->id }}" class="btn btn-block btn-success">Choose Vehicle</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <div class="alert alert-warning">No suitable vehicle found. Edit your filtering or go back to the <a href="{{ route('home.reservation',['step'=>'reservation']) }}"> <b class="text-dark">reservation page</b> </a> </div>
                        @endif
                    </form>
                </div>
            </div>
            @break
            @case('checkout')
            <div class="row" >
                <div class="col-md-4">
                    <div class="card vehicleFilterCard">
                        <div class="card-header d-flex justify-space-between">
                            <h4 class="mb-0 text-center"><span data-feather="edit-3"></span> Reservation Details </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-12 bb-1">
                                            <h5>{{ @$vehicle->vclass->name }}</h5>
                                        </div>
                                        <div class="form-inline rounded p-sm-2  col-4 mt-1">
                                            <img src="{{ Storage::url($vehicle->image) }}" width="100%" >
                                        </div>
                                        <div class="form-inline rounded p-sm-2  col-8 mt-1">
                                            <label class="pl-1 b-1 pt-sm-0 pt-1"> <b class="text-dark">{{ $vehicle->name }}</b> </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-0">Vehicle Details</h5>
                                        </div>
                                        <table class="table mt-2 mb-0">
                                            <thead>
                                                <tr class="bt-0 text-center">
                                                    <th class=" border">
                                                        <span data-feather="users"></span>
                                                    </th>
                                                    <th class=" border">
                                                        <span data-feather="square"></span>
                                                    </th>
                                                    <th class=" border">
                                                        <span data-feather="briefcase"></span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr class="bt-0 text-center">
                                                    <td class=" border">
                                                       <b>{{ $vehicle->seats }} seats</b>
                                                    </td>
                                                    <td class=" border">
                                                       <b>{{ $vehicle->doors }} doors</b>
                                                    </td>
                                                    <td class=" border">
                                                       <b>{{ $vehicle->bags }} bags</b>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-0 mt-4 bb-1 pb-2">Reservation Date Range</h5>
                                        </div>
                                        <div class="col-md-12 pt-2">
                                                {{ \Carbon\Carbon::parse($request->reservation_pick_up_datetime)->format('d/m/Y H:i') }} <b>to</b> {{ \Carbon\Carbon::parse($request->reservation_drop_off_datetime)->format('d/m/Y H:i') }} <br>
                                                <span class="btn btn-warning mt-2"> <b>{{ \Carbon\Carbon::parse($request->reservation_pick_up_datetime)->diff(\Carbon\Carbon::parse($request->reservation_drop_off_datetime))->days }} days</b> </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-0 mt-4 bb-1 pb-2">Reservation Locations</h5>
                                        </div>
                                        <div class="col-md-12 pt-2">
                                            <span> <b>Pick Up:</b> {{$pick_up_office->name}}</span> <br>
                                            <span> <b>Drop Off:</b> @if(isset($request->drop_off_office_id)) {{$drop_off_office->name}} @else {{$pick_up_office->name}} @endif </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('home.reservation.checkout') }}" >
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
                                <label for="">Name Surname</label>
                                <input type="text" class="form-control" name="user[name]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">TC/Passport Number</label>
                                <input type="number" class="form-control" name="user[tcPassportNo]" maxlength="20" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="user[email]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tel">Tel</label>
                                <input type="tel" class="form-control" name="user[tel]" maxlength="20" required>
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
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="billingInformation[name]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Surname</label>
                                <input type="text" class="form-control" name="billingInformation[surname]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">TC/Passport Number</label>
                                <input type="text" class="form-control" name="billingInformation[tcPassportNo]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Company Name</label>
                                <input type="text" class="form-control" name="billingInformation[companyName]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Tax No</label>
                                <input type="text" class="form-control" name="billingInformation[taxNo]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Tax Administration</label>
                                <input type="text" class="form-control" name="billingInformation[TaxAdministration]" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Address</label>
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
                    </form>
                </div>
            </div>
            @break
            @default

        @endswitch

    </div>
</section>
<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="rentalAgreementModal" tabindex="-1" role="dialog" aria-labelledby="rentalAgreementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rentalAgreementModal">Rental Agreement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="kvkkModal" tabindex="-1" role="dialog" aria-labelledby="kvkkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kvkkModal">KVKK Clarification Text</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('scripts')
<script>
$(function () {
    @if($request->step == 'vehicle')
    $('#vehicleFilterForm input').change(function(){
        $('#vehicleFilterForm').submit();
    });
    $('#clearFilter').click(function(){
        $('#vehicleFilterForm input').prop('checked',false);
        $('#vehicleFilterForm').submit();
    });

    @elseif($request->step == 'reservation')
    $('.select2').select2({
        theme: "bootstrap"
    });
    $('#two-inputs').dateRangePicker(
	{
		separator : ' to ',
        format: 'DD.MM.YYYY HH:mm',
        autoClose: true,
        time: {
			enabled: true
		},
        startDate: new Date(),
        defaultTime: moment().startOf('day').toDate(),
		defaultEndTime: moment().endOf('day').toDate(),
		getValue: function()
		{
			if ($('#date-range200').val() && $('#date-range201').val() )
				return $('#date-range200').val() + ' to ' + $('#date-range201').val();
			else
				return '';
		},
		setValue: function(s,s1,s2)
		{
			$('#date-range200').val(s1);
			$('#date-range201').val(s2);
		}
	});
    @endif

});

</script>
@endsection

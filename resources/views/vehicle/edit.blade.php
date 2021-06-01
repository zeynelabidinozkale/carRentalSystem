@extends('layouts.admin')

@section('content')
        <h2> Vehicle / Edit </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">{{ $vehicle->name }}</h4>
                <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('vehicle.update',$vehicle) }}"  enctype="multipart/form-data" novalidate>
                  @csrf
                  <input type="hidden" name="_method" value="PATCH">
                  <div class="row">

                    @if($vehicle->image)
                    <div class="col-md-12 mb-3">
                        <img src="{{ Storage::url($vehicle->image) }}" width="240">
                    </div>
                    @endif
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $vehicle->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">İmage</label>
                        @if($vehicle->image)
                            <input type="hidden" name="imageUrl" value="{{ $vehicle->image }}">
                        @endif
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Seats</label>
                        <input type="number" class="form-control"  name="seats" value="{{ $vehicle->seats }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Bags</label>
                        <input type="number" class="form-control" name="bags" value="{{ $vehicle->bags }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Doors</label>
                        <input type="number" class="form-control" name="doors" value="{{ $vehicle->doors }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Vehicle Class</label>
                        <select class="form-control" name="vclass_id" required>
                            <option value="">---</option>
                            @foreach ($vclasses as $vclass)
                                <option value="{{ $vclass->id }}" @if($vclass->id == $vehicle->vclass_id) selected @endif >{{ $vclass->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Fuel Type</label>
                        <select class="form-control" name="fueltype_id" required>
                            <option value="">---</option>
                            @foreach ($fueltypes as $fueltype)
                                <option value="{{ $fueltype->id }}" @if($fueltype->id == $vehicle->fueltype_id) selected @endif >{{ $fueltype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Gear Type</label>
                        <select class="form-control" name="geartype_id" required>
                            <option value="">---</option>
                            @foreach ($geartypes as $geartype)
                                <option value="{{ $geartype->id }}" @if($geartype->id == $vehicle->geartype_id) selected @endif >{{ $geartype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label for="firstName">Deposit</label>
                        <input type="number" step="0.01" class="form-control" name="deposit" value="{{ $vehicle->deposit }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Cost</label>
                        <input type="number" step="0.01" class="form-control" name="cost" value="{{ $vehicle->cost }}" required>
                    </div> --}}
                    <div class="col-md-12 mb-3">
                        <label for="firstName">Notes</label>
                        <textarea name="notes" rows="2" class="form-control" value="{{ $vehicle->notes }}" >{{ $vehicle->notes }}</textarea>
                    </div>
                  </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
@endsection

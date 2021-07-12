@extends('layouts.admin')

@section('content')
        <h2> Vehicle Class / Edit </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <form autocomplete="off" method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">İmage</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Seats</label>
                        <input type="number" class="form-control" name="seats" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Bags</label>
                        <input type="number" class="form-control" name="bags" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Doors</label>
                        <input type="number" class="form-control" name="doors" required>
                    </div>
                    @csrf
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Vehicle Class</label>
                        <select class="form-control" name="vclass_id" required>
                            <option value="">---</option>
                            @foreach ($vclasses as $vclass)
                                <option value="{{ $vclass->id }}">{{ $vclass->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Fuel Type</label>
                        <select class="form-control" name="fueltype_id" required>
                            <option value="">---</option>
                            @foreach ($fueltypes as $fueltype)
                                <option value="{{ $fueltype->id }}">{{ $fueltype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Gear Type</label>
                        <select class="form-control" name="geartype_id" required>
                            <option value="">---</option>
                            @foreach ($geartypes as $geartype)
                                <option value="{{ $geartype->id }}">{{ $geartype->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label for="firstName">Deposit</label>
                        <input type="number" step="0.01" class="form-control" name="deposit" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Cost</label>
                        <input type="number" step="0.01" class="form-control" name="cost" required>
                    </div> --}}
                    <div class="col-md-12 mb-3">
                        <label for="firstName">Notes</label>
                        <textarea name="notes" rows="2" class="form-control" ></textarea>
                    </div>
                  </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
@endsection

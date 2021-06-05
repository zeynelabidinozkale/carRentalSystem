@extends('layouts.admin')

@section('content')
        <h2> Office / Edit </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-10">
                <h4 class="mb-3">{{ $office->name }}</h4>
                <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('office.update',$office) }}"  >
                  @csrf
                  <input type="hidden" name="_method" value="PATCH">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $office->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $office->address }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $office->email }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Tel</label>
                        <input type="phone" class="form-control" name="tel" value="{{ $office->tel }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Latitude</label>
                        <input type="text" class="form-control" name="latitude" value="{{ $office->latitude }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Longitude</label>
                        <input type="text" class="form-control" name="longitude" value="{{ $office->longitude }}">
                    </div>
                  </div>
                  <hr class="mb-4">
                  <h4 class="mb-3">Vehicles</h4>
                  <div class="row">
                    @foreach ($vehicles as $vehicle)
                    <div class="col-md-2 mb-3">
                        @if($vehicle->image) <img src="{{ Storage::url($vehicle->image) }}" height="100"> @else <img src="/img/noImage/noImage.png" height="100" > @endif
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="firstName">Vehicle Name</label>
                      <input type="text" class="form-control" value="{{ $vehicle->name }}" disabled >
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="firstName">Deposit</label>
                        <input type="number" step="0.01" class="form-control" name="vehicle[{{$vehicle->id}}][deposit]" @if($office->vehicles->contains($vehicle)) value="{{ $office->vehicles->find($vehicle)->pivot->deposit }}" @else value="{{ $vehicle->deposit }}" @endif>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="firstName">Rental Cost</label>
                        <input type="number" step="0.01" class="form-control" name="vehicle[{{$vehicle->id}}][cost]" @if($office->vehicles->contains($vehicle)) value="{{ $office->vehicles->find($vehicle)->pivot->cost }}" @else value="{{ $vehicle->cost }}" @endif >
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="firstName">Qty</label>
                        <input type="number" class="form-control" name="vehicle[{{$vehicle->id}}][qty]" @if($office->vehicles->contains($vehicle)) value="{{ $office->vehicles->find($vehicle)->pivot->qty }}" @else value="{{ $vehicle->qty }}" @endif >
                    </div>
                    <div class="col-md-1 mb-3 text-center">
                        <label for="firstName">Active</label> <br>
                        <input type="checkbox" class="mt-3" name="vehicle[{{$vehicle->id}}][active]" value="1" @if($office->vehicles->contains($vehicle)) @if($office->vehicles->find($vehicle)->pivot->active) checked @endif @endif >
                    </div>
                    @endforeach
                  </div>
                  <button class="btn btn-primary" name="redirect" value="saveAndGoBack" type="submit">Save and Go Back</button>
                  <button class="btn btn-secondary" name="redirect" value="saveAndStayOnThisPage" type="submit">Save and Stay on This Page</button>
                </form>
            </div>
        </div>
@endsection

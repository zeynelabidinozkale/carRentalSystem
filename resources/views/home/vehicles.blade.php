@extends('layouts.app')
@section('content')
      <section class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <img src="{{asset('/assets/brand/logo.svg')}}" class="translate-logo mb-2" height="100">
                    <h3>{{ env('APP_NAME') }} - Our Vehicles</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>features</th>
                            <th>Category</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>@if($vehicle->image) <img src="{{ asset(Storage::url($vehicle->image))}}" width="100"> <br> @else <img src="{{asset('/img/noImage/noImage.png')}}" width="100" > <br> @endif {{ $vehicle->name }}</td>
                              <td>{{ $vehicle->seats }} seats, {{ $vehicle->bags }} bags, {{ $vehicle->doors }} doors   </td>
                              <td><b>fuel type:</b> {{ @$vehicle->fueltype->name }}, <b>gear type:</b> {{ @$vehicle->geartype->name }}, <b>Vehicle Class:</b> {{ @$vehicle->vclass->name }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $vehicles->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

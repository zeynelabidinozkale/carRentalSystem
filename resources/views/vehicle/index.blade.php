@extends('layouts.admin')

@section('content')
        <div class="d-flex justify-space-between">
            <h2>Vehicles</h2>
            <a href="{{route('vehicle.create')}}" class="btn btn-success align-self-center">+ Create</a>
        </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>image</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($vehicles as $vehicle)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> @if($vehicle->image) <img src="{{ asset(Storage::url($vehicle->image)) }}" width="100"> @else <img src="{{ asset('/img/noImage/noImage.png') }}" width="100" > @endif</td>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->created_at }}</td>
                    <td>{{ $vehicle->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm mr-1" href="{{route('vehicle.edit',$vehicle->id)}}">Edit</a>
                        <form autocomplete="off" class="delete d-inline" action="{{route('vehicle.destroy',$vehicle->id)}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE"> {{csrf_field()}} <button class="btn btn-danger btn-sm mr-1 confirmation" type="submit">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            {{ $vehicles->links() }}
          </div>
@endsection

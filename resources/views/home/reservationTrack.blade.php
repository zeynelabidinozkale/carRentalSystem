@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card mt-5 mb-5">
       <div class="card-header">
          <h4>Reservation Tracking</h4>
       </div>
       <div class="card-body">
            <form action="{{ route('home.reservation.trackResult') }}" method="POST" class="row mb-4">
                @csrf
                <div class="col-md-3"></div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="trackNumber">Tracking Number</label>
                        <input type="text" class="form-control" name="trackNumber" id="trackNumber" required>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button class="btn btn-success" type="submit">Continue <i class="fa fa-arrow-right"></i> </button>
                </div>
            </form>
          </div>
       </div>
    </div>
 </div>

@endsection

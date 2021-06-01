@extends('layouts.admin')

@section('content')
        <h2> Office / Edit </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('office.store') }}" novalidate>
                  @csrf
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Tel</label>
                        <input type="phone" class="form-control" name="tel">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Latitude</label>
                        <input type="text" class="form-control" name="latitude">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Longitude</label>
                        <input type="text" class="form-control" name="longitude">
                    </div>
                  </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
@endsection

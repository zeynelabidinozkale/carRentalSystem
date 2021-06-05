@extends('layouts.admin')

@section('content')
        <h2> Gear Type / Edit </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">{{ $geartype->name }}</h4>
                <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('geartype.update',$geartype) }}"  >
                  @csrf
                  <input type="hidden" name="_method" value="PATCH">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $geartype->name }}" required>
                    </div>
                  </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
@endsection

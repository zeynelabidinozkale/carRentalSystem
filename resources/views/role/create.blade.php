@extends('layouts.admin')

@section('content')
        <h2> Role / Edit </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('role.store') }}"  >
                  @csrf
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 mb-3">
                        <input type="checkbox" name="panelLogin" value="1" id="panelLogin" >
                        <label for="panelLogin">Has Permission To Control Panel</label>
                    </div>
                  </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
@endsection

@extends('layouts.admin')

@section('content')
        <h2> Users / Create </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <form class="needs-validation" method="POST" action="{{ route('user.store') }}" novalidate>
                  @csrf
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Tel</label>
                        <input type="email" class="form-control" name="tel" maxlength="20">
                    </div>
                  </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Role</h4>
                    <div class="d-block my-3">
                        @foreach ($roles as $role)
                        <div class="custom-control custom-radio d-inline mr-2">
                            <input id="{{$role->name}}" name="role_id" type="radio" value="{{ $role->id }}" class="custom-control-input" @if($role->name == $request->role) checked @endif  required>
                            <label class="custom-control-label" for="{{$role->name}}">{{$role->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
@endsection

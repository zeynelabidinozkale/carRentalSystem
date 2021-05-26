@extends('layouts.admin')

@section('content')
        <h2> Users / Edit </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">{{ $user->name }}</h4>
                <form class="needs-validation" method="POST" action="{{ route('user.update',$user) }}" novalidate>
                  @csrf
                  <input type="hidden" name="_method" value="PATCH">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="you@example.com" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Tel</label>
                        <input type="email" class="form-control" value="{{ $user->tel }}" name="tel" >
                    </div>
                  </div>
                    @if($user->hasRole('admin'))
                    <hr class="mb-4">
                    <h4 class="mb-3">Role</h4>
                    <div class="d-block my-3">
                        @foreach ($roles as $role)
                        <div class="custom-control custom-radio d-inline mr-2">
                            <input id="{{$role->name}}" name="role_id" type="radio" value="{{ $role->id }}" class="custom-control-input" @if($user->role->name == $role->name) checked @endif required>
                            <label class="custom-control-label" for="{{$role->name}}">{{$role->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <hr class="mb-4">
                  <button class="btn btn-primary" name="redirect" value="saveAndGoBack" type="submit">Save and Go Beck</button>
                  <button class="btn btn-secondary" name="redirect" value="saveAndStayOnThisPage" type="submit">Save and Stay on This Page</button>
                </form>
            </div>
        </div>
@endsection

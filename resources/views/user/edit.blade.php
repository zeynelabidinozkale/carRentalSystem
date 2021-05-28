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
                    <div class="col-md-4 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="you@example.com" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Tel</label>
                        <input type="email" class="form-control" value="{{ $user->tel }}" name="tel" maxlength="20">
                    </div>
                  </div>
                    @if($user->is(auth()->user()))
                    <hr class="mb-4">
                    <h4 class="mb-3">Password</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#changePassword">
                                <span data-feather="key"></span> Change Password
                            </button>
                        </div>
                    </div>
                    @endif
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
                  <button class="btn btn-primary" name="redirect" value="saveAndGoBack" type="submit">Save and Go Back</button>
                  <button class="btn btn-secondary" name="redirect" value="saveAndStayOnThisPage" type="submit">Save and Stay on This Page</button>
                </form>
            </div>
        </div>

        @if($user->is(auth()->user()))
            <!-- Modal -->
            <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="needs-validation" method="POST" action="{{ route('user.update',$user) }}" novalidat>
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 mb-3">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control" name="password[currentPassword]" required >
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="email">New Password</label>
                                    <input type="password" class="form-control" name="password[newPassword]" required >
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="email">Confirm Password</label>
                                    <input type="password" class="form-control" name="password[confirmNewPassword]" required >
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="passwordChange" value="passwordChange" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
@endsection

@extends('layouts.app')
@section('content')

<section class="mt-5 mb-100">
    <div class="container mb-5">
        <div class="row" >
            <div class="col-md-3">
                @include('partial.app.accountSidebar')
            </div>
            <div class="col-md-9">
                <h4 class="mb-3">{{ $user->name }}</h4>
                <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('account.update') }}" novalidate>
                  @csrf
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">TC/Passport Number</label>
                        <input type="number" class="form-control" name="tcPassportNo" value="{{ $user->tcPassportNo }}" maxlength="20" required>
                    </div>
                    <div class="col-md-4 mb-3"></div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Tel</label>
                        <input type="email" class="form-control" value="{{ $user->tel }}" name="tel" maxlength="20">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" value="{{ $user->address }}" rows="2">{{ $user->address }}</textarea>
                    </div>
                  </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Password</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#changePassword">
                                <span data-feather="key"></span> Change Password
                            </button>
                        </div>
                    </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>

    </div>
</section>

<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('user.update',$user) }}" novalidat>
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
@endsection

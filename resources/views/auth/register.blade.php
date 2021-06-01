@extends('layouts.auth')
@section('styles')

@endsection
@section('content')

        <form autocomplete="off" method="POST" action="{{ route('register') }}">
            <div class="form-group mb-0">
                <div class="col-md-12 text-center">
                     <img class="mb-4" src="/assets/brand/logo.svg" alt="" width="72" height="57">
                     <h1 class="h3 mb-0 fw-normal">Register</h1>
                </div>
            </div>
            @csrf
            <div class="form-group text-left">
                <label for="name" >{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group ">
                <label for="email" >{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group ">
                    <label for="password" >{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="form-group mb-2">
                <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group mb-2">
                <button type="submit" class="btn btn-primary btn-block" style="width: 100%;">
                    {{ __('Register') }}
                </button>
            </div>

            <div class="form-group mb-0 d-flex justify-space-between">
                <a href="{{ route('login') }}">Back to Login</a>
                <a href="/">Home</a>
            </div>
        </form>


@endsection
@section('scripts')
@endsection

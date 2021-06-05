@extends('layouts.admin')

@section('content')
        <h2> Users / Create </h2>
        <hr class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <form autocomplete="off" class="needs-validation" method="POST" action="{{ route('user.store') }}" >
                  @csrf
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="firstName">Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="firstName">TC/Passport Number</label>
                        <input type="number" class="form-control" name="tcPassportNo" maxlength="20" required>
                    </div>
                    <div class="col-md-4 mb-3"></div>
                    <div class="col-md-4 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tel">Tel</label>
                        <input type="tel" class="form-control" name="tel" maxlength="20">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" rows="2"></textarea>
                    </div>
                  </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Office</h4>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="offices">Offices</label>
                            <select class="select2 form-control" name="offices[]" multiple>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}"> {{ $office->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Role</h4>
                    <div class="d-block my-3">
                        @foreach ($roles as $role)
                        @if(!auth()->user()->hasRole('admin'))
                        @if($role->name!='admin')
                        <div class="custom-control custom-radio d-inline mr-2">
                            <input id="{{$role->name}}" name="role_id" type="radio" value="{{ $role->id }}" class="custom-control-input" @if($role->name == $request->role) checked @endif required>
                            <label class="custom-control-label" for="{{$role->name}}">{{$role->name}}</label>
                        </div>
                        @endif
                        @else
                        <div class="custom-control custom-radio d-inline mr-2">
                            <input id="{{$role->name}}" name="role_id" type="radio" value="{{ $role->id }}" class="custom-control-input" @if($role->name == $request->role) checked @endif required>
                            <label class="custom-control-label" for="{{$role->name}}">{{$role->name}}</label>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <hr class="mb-4">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
@endsection

@section('scripts')
<script>
$(function () {
    $('.select2').select2({
        theme: "bootstrap"
    });
});

</script>
@endsection

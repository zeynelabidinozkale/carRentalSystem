@extends('layouts.admin')

@section('content')
        <div class="d-flex justify-space-between">
            <h2>Users</h2>
            <span class="d-flex">
                <a href="{{route('user.create',['role'=>$request->role])}}" class="btn btn-success align-self-center mr-2">+ Create</a>
                <div class="dropdown align-self-center">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filter Role @isset($request->role)({{$request->role}})@endisset
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('user.index') }}">All</a>
                        @foreach (\App\Models\Role::all() as $role)
                            <a class="dropdown-item" href="{{ route('user.index',['role'=>$role->name]) }}">{{$role->name}}</a>
                        @endforeach
                    </div>
                </div>
            </span>
        </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Tel</th>
                  <th>e-mail</th>
                  <th>Registered</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ @$user->role->name }}</td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm mr-1" href="{{route('user.edit',$user->id)}}">Edit</a>
                        <a class="btn btn-warning btn-sm mr-1 confirmation" href="{{route('sendCredentials',$user->id)}}">Send Credentials</a>
                        <form autocomplete="off" class="delete d-inline" action="{{route('user.destroy',$user->id)}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE"> {{csrf_field()}} <button class="btn btn-danger btn-sm mr-1 confirmation" type="submit">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            {{ $users->links() }}
          </div>
@endsection

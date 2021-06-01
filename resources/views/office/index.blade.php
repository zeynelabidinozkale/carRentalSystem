@extends('layouts.admin')

@section('content')
        <div class="d-flex justify-space-between">
            <h2>Offices</h2>
            <a href="{{route('office.create')}}" class="btn btn-success align-self-center">+ Create</a>
        </div>
          <div >
            <table class="table table-striped table-hover table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($offices as $office)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $office->name }}</td>
                    <td>{{ $office->created_at }}</td>
                    <td>{{ $office->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm mr-1" href="{{route('office.edit',$office->id)}}">Edit</a>
                        <form autocomplete="off" class="delete d-inline" action="{{route('office.destroy',$office->id)}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE"> {{csrf_field()}} <button class="btn btn-danger btn-sm mr-1 confirmation" type="submit">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            {{ $offices->links() }}
          </div>
@endsection

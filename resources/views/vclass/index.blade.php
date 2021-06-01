@extends('layouts.admin')

@section('content')
        <div class="d-flex justify-space-between">
            <h2>Vehicle Classes</h2>
            <a href="{{route('vclass.create')}}" class="btn btn-success align-self-center">+ Create</a>
        </div>
          <div class="table-responsive">
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
                  @foreach ($vclasses as $vclass)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vclass->name }}</td>
                    <td>{{ $vclass->created_at }}</td>
                    <td>{{ $vclass->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm mr-1" href="{{route('vclass.edit',$vclass->id)}}">Edit</a>
                        <form autocomplete="off" class="delete d-inline" action="{{route('vclass.destroy',$vclass->id)}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE"> {{csrf_field()}} <button class="btn btn-danger btn-sm mr-1 confirmation" type="submit">Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            {{ $vclasses->links() }}
          </div>
@endsection

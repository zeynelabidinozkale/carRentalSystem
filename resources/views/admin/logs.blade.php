@extends('layouts.admin')

@section('content')
        <div >
            <h2>Logs</h2>
        </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Model Name</th>
                  <th>Model ID</th>
                  <th>Action</th>
                  <th>Created At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @php
                      $i = 0;
                  @endphp
                  @foreach ($logs as $log)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $log->model }}</td>
                    <td>{{ $log->model_id }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->created_at }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
@endsection

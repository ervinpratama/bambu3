@extends('layouts.app')

@section('title', 'Data Super Admin')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Super Admin</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('superadmin.tambah') }}" class="btn btn-primary mb-3">Tambah Super Admin</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Super Admin</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($superadmin as $row)
            <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $row->nama }}</td>
              <td>{{ $row->email }}</td>
              <td>
                <a href="{{ route('superadmin.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('superadmin.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

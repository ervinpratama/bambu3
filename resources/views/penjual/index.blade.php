@extends('layouts.app')

@section('title', 'Data Penjual')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Penjual</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('penjual.tambah') }}" class="btn btn-primary mb-3">Tambah Penjual</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penjual</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($penjual as $row)
            <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $row->nama }}</td>
              <td>{{ $row->email }}</td>
              <td>
                <a href="{{ route('penjual.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('penjual.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

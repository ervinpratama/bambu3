@extends('layouts.app')

@section('title', 'Form Super Admin')

@section('contents')
    <form action="{{ isset($superadmin) ? route('superadmin.update', $superadmin->id) : route('superadmin.simpan') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($superadmin) ? 'Form Edit Super Admin' : 'Form Tambah Super Admin' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Super Admin</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                   name="nama" value="{{ isset($superadmin) ? $superadmin->nama : '' }}">
                            @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                   value="{{ isset($superadmin) ? $superadmin->email : '' }}">
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Passowrd</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                   value="{{ isset($superadmin) ? $superadmin->password : '' }}">
                            @error('password')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation"
                                   value="{{ isset($superadmin) ? $superadmin->password : '' }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

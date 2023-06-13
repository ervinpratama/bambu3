@extends('layouts.app')

@section('title', 'Form Barang')

@section('contents')
    <form action="{{ isset($barang) ? route('barang.tambah.update', $barang->id) : route('barang.tambah.simpan') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ isset($barang) ? 'Form Edit Barang' : 'Form Tambah Barang' }}</h6>
                    </div>
                    <div class="card-body">
                        <!-- <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang"
                                   value="{{ isset($barang) ? $barang->kode_barang : '' }}" readonly>
                            @error('kode_barang')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> -->
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang"
                                   value="{{ isset($barang) ? $barang->nama_barang : '' }}">
                            @error('nama_barang')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori Barang</label>
                            <select name="id_kategori" id="id_kategori" class="custom-select @error('id_kategori') is-invalid @enderror">
                                <option value="" selected disabled hidden>-- Pilih Kategori --</option>
                                @foreach ($kategori as $row)
                                    <option
                                        value="{{ $row->id }}" {{ isset($barang) ? ($barang->id_kategori == $row->id ? 'selected' : '') : '' }}>{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Barang</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                                   value="{{ isset($barang) ? $barang->harga : '' }}">
                            @error('harga')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ukuran">Ukuran Barang</label>
                            <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" name="ukuran"
                                   value="{{ isset($barang) ? $barang->ukuran : '' }}">
                            @error('ukuran')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah"
                                   value="{{ isset($barang) ? $barang->jumlah : '' }}">
                            @error('jumlah')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gambar">Foto Barang</label><br/>
                            @if (isset($barang))
                                <img src="{{ asset('foto_product/'.$barang->foto)}}" width="200" alt="">
                            @endif
                            <input name="foto" type="file" class="form-control mt-2 @error('foto') is-invalid @enderror">
                            @error('foto')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
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
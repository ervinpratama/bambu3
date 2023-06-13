@extends('customer.layout')

@section('content')

<div class="container">
    <h3>Product Details</h3>
        <hr/>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-content-details">
                            <img src="{{ asset("foto_product/".$barang->foto) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table  width="100%">
                    <tr>
                        <th colspan="2"><h4>{{ $barang->nama_barang}}</h4></th>
                    </tr>
                    <tr>
                        <td width="20%">Kode Barang</td>
                        <td>: {{ $barang->kode_barang}}</td>
                    </tr>
                    <tr>
                        <td>Karegori</td>
                        <td>: {{ $barang->kategori->nama}}</td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>: {{ $barang->jumlah}}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>: Rp {{ number_format($barang->harga, 0,',','.')}}</td>
                    </tr>
                    <tr>
                        <td>Ukuran Produk</td>
                        <td>: {{ $barang->ukuran}}</td>
                    </tr>
                </table>

                <a href="/cart/{{$barang->id}}/add" class="btn btn-success my-3"><i class="fas fa-shopping-cart"></i> Masukan Keranjang</button></a>
            </div>
        </div>
</div>

@endsection

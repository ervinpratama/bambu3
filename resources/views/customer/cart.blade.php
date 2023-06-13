@extends('customer.layout')

@section('content')

<div class="container">
    <h3>Shopping Cart</h3>
        <hr/>
        <div class="row">
            <div class="card">
                <div class="card-body">
                  <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th width="50%">Nama Produk</th>
                            <th width="15%">Harga Produk</th>
                            <th width="20%">Jumlah</th>
                            <th width="15%">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($carts as $item)
                            @php
                                $total += $item->price * $item->qty;
                            @endphp
                            <tr>
                                <td class="align-middle">{{$item->nama_barang}}</td>
                                <td class="align-middle">Rp <span style="float:right">{{ number_format(($item->price),0,',','.')}}</span></td>
                                <td class="align-middle">
                                    <div class="container-fluid d-flex">
                                        <a href="cart/{{$item->barang_id}}/remove" class="btn btn-info btn-sm"><i class="fas fa-minus"></i></a>
                                        <input type="number"min="0" class="form-control mx-2 text-center" value="{{$item->qty}}" readonly>
                                        <a href="cart/{{$item->barang_id}}/add" class="btn btn-info btn-sm"><i class="fas fa-plus"></i></a></td>
                                    </div>
                                <td class="align-middle">Rp <span style="float:right">{{number_format(($item->price * $item->qty),0,',','.')}}</span></td>
                            </tr>
                        @endforeach
                        <tr style="border-top:2px solid #000">
                            <td class="align-middle" align="right" colspan="3" ><b>Total :</b></td>
                            <td class="align-middle text-bold"><b>Rp<span style="float:right">{{number_format(($total),0,',','.')}}</span></b></td>
                        </tr>
                    </tbody>
                  </table>
                  <a href="/transaction/checkout" class="btn btn-success">Checkout</a>
                </div>
            </div>
        </div>
</div>

@endsection

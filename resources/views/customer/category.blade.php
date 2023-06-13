@extends('customer.layout')

@section('content')

<div class="container">
    <h3 class="mt-5">{{ $kategori }}</h3>
    <hr/>
    <div class="row">
        @foreach ($barang as $item)
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-content">
                        <img src="{{ asset("foto_product/".$item->foto) }}" alt="">
                        <h5>{{ $item->nama_barang}}</h5>
                        <a href="/customer/detail/{{ $item->id }}" class="btn btn-secondary"><i class="fas fa-eye"></i> Details</a>
                    </div>
                </div>
            </div>
        </div>   
        @endforeach
    </div>
</div>
    
@endsection
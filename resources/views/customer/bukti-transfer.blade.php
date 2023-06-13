@extends('customer.layout')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Upload Bukti Transfer
        </div>
        
        <div class="card-body">
            <form action="{{ route("upload.bukti") }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf

                <div class="form-group">
                    <label for="" class="my-2">ORDER ID</label>
                    <input name="order_id" type="hidden" class="form-control" value="{{ $transaction->id }}" readonly>
                    <input type="text" class="form-control" value="{{ $transaction->order_id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="" class="my-2">Bukti Transfer</label>
                    <input type="file" name="bukti" class="form-control" value="{{ $transaction['order_id'] }}">
                </div>

                <button type="submit" class="btn btn-success mt-3">Upload</button>
            </form>
        </div>
    </div>
</div>
    
@endsection
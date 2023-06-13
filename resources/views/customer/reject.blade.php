@extends('customer.layout')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Upload Reject
        </div>
        
        <div class="card-body">
            <form action="{{ url("transaction/store_reject") }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf

                <div class="form-group">
                    <label for="" class="my-2">ORDER ID</label>
                    <input name="id" type="hidden" class="form-control" value="{{ $transaction->id }}" readonly>
                    <input type="text" class="form-control" value="{{ $transaction->order_id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="" class="my-2">Bukti Transfer</label>
                    <input type="file" name="images[]" class="form-control mb-2" required>
                    <input type="file" name="images[]" class="form-control mb-2">
                    <input type="file" name="images[]" class="form-control mb-2">
                    <input type="file" name="images[]" class="form-control mb-2">
                    <input type="file" name="images[]" class="form-control mb-2">
                </div>
                <div class="form-group">
                    <label for="" class="my-2">Alasan</label>
                    <textarea name="alasan" cols="30" rows="10" required class="form-control">{{ isset($transaction->reject->alasan) ? $transaction->reject->alasan : '' }}</textarea>
                </div>
                @if(!isset($transaction->reject->alasan))
                <button type="submit" class="btn btn-success mt-3">Reject</button>
                @endif
            </form>
        </div>
    </div>
</div>
    
@endsection
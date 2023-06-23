@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <form action="{{ route('exportPDF')}}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <input name="daterange" type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-sm">Export Data</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <form action="" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Filter by Status</label><br/>
                    </div>
                    <div class="col-md-7">
                            <select name="status" id="byStatus" class="form-control form-control-sm">
                                <option value="">All</option>
                                <option value="acc">Acc</option>
                                <option value="pending">Pending</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                           
                       
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-sm w-100" type="submit">Filter</button>
                    </div>
                
                
                </div>
            </form>
            </div>
        </div>
        <table class="table table-bordered" id="data" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Data</th>
                <th width="5%">Bukti Transfer</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="card my-2">
                            <div class="card-header">
                                Order ID: {{ $transaction->order_id }}<br>
                                Status : 
                        @if ($transaction->bukti_transfer == null)
                        <span class="badge badge-danger">None</span>
                        @elseif(isset($transaction->reject->status) && $transaction->reject->status == 'pending')
                         <span class="badge badge-danger">Reject Pending</span>
                        @elseif(isset($transaction->reject->status) && $transaction->reject->status == 'diterima')
                         <span class="badge badge-danger">Pembatalan Diterima</span>
                        @elseif(isset($transaction->reject->status) && $transaction->reject->status == 'ditolak')
                         <span class="badge badge-danger">Pembatalan Ditolak</span>
                        @elseif($transaction->bukti_transfer->status == 'acc')
                         <span class="badge badge-success">Pesanan Diterima</span>
                        @elseif($transaction->bukti_transfer->status == 'dikirim')
                         <span class="badge badge-success">Pesanan Dikirim</span>
                        @elseif($transaction->bukti_transfer->status == 'dibatalkan')
                         <span class="badge badge-danger">Pesanan Dibatalkan</span>
                        @elseif($transaction->bukti_transfer->status == 'selesai')
                         <span class="badge badge-info">Pesanan Selesai</span>
                        @else
                        <span class="badge badge-warning">Pending</span>
                        @endif
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td width="15%">Pembeli</td>
                                        <td>: {{ $transaction->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Alamat Pengiriman</td>
                                        <td>: {{ $transaction->alamat.", ". $transaction->desa_kelurahan.", ".$transaction->kecamatan.", ".$transaction->kabupaten_kota.", ".$transaction->provinsi." - ".$transaction->kodepos}}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Nomor HP</td>
                                        <td>: {{ $transaction->no_hp}}</td>
                                    </tr>
                                </table>
                                <h5>Order Details</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="50%">Items</th>
                                            <th width="15%">Harga</th>
                                            <th width="20%">Qty</th>
                                            <th width="15%">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($details as $item)

                                            @if ($transaction->id == $item->transaction_id) 
                                                
                                                @php
                                                    
                                                    $total += $item->qty * $item->price;
                                                @endphp 
                                                <tr>
                                                    <td>{{ $item->nama_barang}}</td>
                                                    <td>Rp <span style="float:right">{{ number_format(($item->price),0,',','.')}}</span></td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>Rp <span style="float:right">{{ number_format(($item->qty * $item->price),0,',','.')}}</span></td>
                                                </tr>
                                                
                                                @endif
                                                
                                        @endforeach
                                        <tr style="font-weight: bold; border-top:2px solid #000">
                                            <td colspan="3" align="right">Total :</td>
                                            <td>Rp <span style="float:right">{{number_format(($total+ $transaction->ongkir),0,',','.')}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                    <td>
                        
                        @if ($transaction->bukti_transfer != null)
                        <button data-gambar="{{ $transaction->bukti_transfer->gambar}}" type="button" class="lihat-bukti btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            Lihat Bukti Transfer
                          </button>
                        @else
                         <span class="badge badge-warning">Belum Ada Bukti Transfer</span>
                        @endif
                    </td>
                    <td>
                        @if (isset($transaction->bukti_transfer->status) && $transaction->bukti_transfer->status == 'pending')
                        <a href="/transaction/accept/{{$transaction->id}}" class="btn btn-success btn-sm">Acc</a>
                        @elseif(isset($transaction->bukti_transfer->status) && $transaction->bukti_transfer->status == 'acc')
                        <a href="/transaction/kirim/{{$transaction->id}}" class="btn btn-success btn-sm">Kirim</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <img src="" alt="" id="bukti" width="100%">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>
$(document).ready(function(){
    $('#data').on('click', '.lihat-bukti', function() {
        let gambar = $(this).data('gambar')
        console.log(gambar);

        $('#bukti').attr('src', `bukti_transfer/${gambar}`)
    });


    var table = $('#data').DataTable();
});

</script>

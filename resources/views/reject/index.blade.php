@extends('layouts.app')

@section('title', 'Data Pembatalan')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Pembatalan</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Order ID</th>
                <th width="40%">Foto</th>
                <th width="30%">Alasan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                
                @foreach ($reject as $val)
                <?php  
                    $images = explode('|', $val->images);
                ?>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $val->transaction->order_id }}</td>
                    <td>
                        <?php foreach ($images as $val_image): ?>
                            @if($val_image)
                            <div style="max-width: 120px;max-height: 120px;display: inline-block;margin: 10px;">
                                <img src="{{ asset('images/reject/'.$val_image) }}" width="110">
                            </div>
                            @endif
                        <?php endforeach ?>
                    </td>
                    <td>{{ $val->alasan }}</td>
                    <td>{{ $val->status }}</td>
                    <td>
                        @if ($val->status == 'pending')
                        <a href="/reject/change_status/{{$val->transaction_id}}/diterima" class="btn btn-primary btn-sm mb-2">Terima</a>
                        <a href="/reject/change_status/{{$val->transaction_id}}/ditolak" class="btn btn-warning btn-sm">Tolak</a>
                        @else
                        -
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
    $('.lihat-bukti').click(function(){
        let gambar = $(this).data('gambar')
        console.log(gambar);

        $('#bukti').attr('src', `bukti_transfer/${gambar}`)
    })
})
</script>

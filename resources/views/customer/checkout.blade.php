@extends('customer.layout')

@section('content')

<div class="container">
    <h3>Checkout</h3>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Informasi Pembayaran
                </div>
                <div class="card-body">
                    <p>Untuk Pembayaran dapat di transfer ke rekening di bawah ini sebesar: <br/><b>Rp. {{ number_format(total_belanja(),0,',','.') }}</b></p>
                    <div class="payment">
                        <img src="{{ asset('img/logo-bri.png')}}" width="80" alt="Logo BRI">
                        <div>
                            <h5>Bank BRI</h5>
                            <p>No. Rekening : <b>1077-034-176</b> atas nama <b>INDRA SURYAWATI</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Informasi Pengiriman
                </div>
                <div class="card-body">
                    <form action="/transaction/proses" method="POST">
                        @method('POST')
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">No. Handphone</label>
                            <input name="no_hp" type="text" class="form-control" placeholder="No. HP" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Alamat</label>
                            <textarea name="alamat" type="text" class="form-control" placeholder="Alamat Lengkap" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Provinsi</label>
                            <input name="provinsi" type="text" class="form-control" placeholder="Provinsi" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Kabupaten/Kota</label>
                            <input name="kabupaten_kota" type="text" class="form-control" placeholder="Kabupaten/Kota" required/>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Kecamatan</label>
                            <input name="kecamatan" type="text" class="form-control" placeholder="Kecamatan" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Desa/Kelurahan</label>
                            <input name="desa_kelurahan" type="text" class="form-control" placeholder="Desa/Kelurahan" required/>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Kode POS</label>
                            <input name="kodepos" type="text" class="form-control" placeholder="Kode POS" required>
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-success">Proses Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

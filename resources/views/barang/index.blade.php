@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if (auth()->user()->level == 'Penjual')
                        <a href="{{ route('barang.tambah') }}" class="btn btn-primary mb-3">Tambah Barang</a>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Filter by Category : </label><br/>
                        </div>
                        <div class="col-md-8">
                            <select name="" id="byCategory" class="form-control form-control-sm">
                                <option value="all">All</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ukuran</th>
                        <th>Jumlah</th>
                        @if (auth()->user()->level == 'Penjual')
                            <th>Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $row->kode_barang }}</td>
                            <td>{{ $row->nama_barang }}</td>
                            <td>{{ $row->kategori->nama }}</td>
                            <td>{{ $row->harga }}</td>
                            <td>{{ $row->ukuran }}</td>
                            <td>{{ $row->jumlah }}</td>
                            @if (auth()->user()->level == 'Penjual')
                                <td>
                                    <a href="{{ route('barang.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('barang.hapus', $row->id) }}" class="btn btn-danger">Hapus</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#byCategory').change(function(){

        let id = $('#byCategory').val()

            getByCategory(id)
        })
    });

    const getByCategory = async (id) => {
        try {

            if (id == 'all') {
                window.location.reload(); // Reload the page
                return;
            }

            let response = await $.get({
                url: `<?= route('barang.category', '') ?>/${id}`
            });

            $('#dataTable tbody').empty();

            if (response && response.barang && Array.isArray(response.barang)) {
                response.barang.forEach((item, index) => {
                    let tableRow = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.kode_barang}</td>
                            <td>${item.nama_barang}</td>
                            <td>${item.kategori.nama}</td>
                            <td>${item.harga}</td>
                            <td>${item.ukuran}</td>
                            <td>${item.jumlah}</td>
                            `;

                            tableRow += `
                            <td>
                                <a href="<?= route('barang.edit', '') ?>/${item.id}" class="btn btn-warning">Edit</a>
                                <a href="<?= route('barang.hapus', '') ?>/${item.id}" class="btn btn-danger">Hapus</a>
                            </td>`;

                            tableRow += `</tr>`;

                            // console.log(tableRow)

                    $('#dataTable tbody').append(tableRow);
                })
            }
        console.log(response)
        } catch (error) {
            
        }
       
    }
</script>

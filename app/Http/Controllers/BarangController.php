<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;

use Illuminate\Http\Request;

class BarangController extends Controller
{
	public function index()
	{
		$barang = Barang::get();

		return view('barang.index', ['data' => $barang]);
	}

	public function tambah()
	{
		$kategori = Kategori::get();

		return view('barang.form', ['kategori' => $kategori, 'jumlahBarang' => 0]);
	}

	public function simpan(Request $request)
	{
        $this->validate($request, [
            // 'kode_barang' => 'required',
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'ukuran' => 'required',
            'foto' => 'required',
        ]);

		$foto = time().'.'.$request->foto->extension();

		$data = [
			'kode_barang' => $request->kode_barang,
			'nama_barang' => $request->nama_barang,
			'id_kategori' => $request->id_kategori,
			'harga' => $request->harga,
			'jumlah' => $request->jumlah,
            'ukuran' => $request->ukuran,
			'foto' => $foto
		];

		// Mengurangi stok barang
			$barang = Barang::create($data);
			// $barang->jumlah -= $request->jumlah;
			// $barang->save();

		// Barang::create($data);

		// Public Folder
        $request->foto->move(public_path('foto_product'), $foto);

		return redirect()->route('barang');
	}

	public function edit($id)
	{
		$barang = Barang::find($id);
		$kategori = Kategori::get();

		return view('barang.form', ['barang' => $barang, 'kategori' => $kategori]);
	}

	public function update($id, Request $request)
	{
        $this->validate($request, [
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'ukuran' => 'required',
        ]);
        
		if($request->foto != null) {

			$foto = time().'.'.$request->foto->extension();

			$data = [
				'kode_barang' => $request->kode_barang,
				'nama_barang' => $request->nama_barang,
				'id_kategori' => $request->id_kategori,
				'harga' => $request->harga,
				'jumlah' => $request->jumlah,
                'ukuran' => $request->ukuran,
				'foto' => $foto
			];

			$request->foto->move(public_path('foto_product'), $foto);

		} else {
			$data = [
				'kode_barang' => $request->kode_barang,
				'nama_barang' => $request->nama_barang,
				'id_kategori' => $request->id_kategori,
				'harga' => $request->harga,
				'jumlah' => $request->jumlah,
                'ukuran' => $request->ukuran,
			];
		}

			Barang::find($id)->update($data);

			return redirect()->route('barang');
	}

	public function hapus($id)
	{
		Barang::find($id)->delete();

			return redirect()->route('barang');
	}
}
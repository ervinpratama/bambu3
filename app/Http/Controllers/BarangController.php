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
		$categories = Kategori::all();

		return view('barang.index', ['data' => $barang, 'categories' => $categories]);
	}

	public function tambah()
	{
		$kategori = Kategori::get();

		return view('barang.form', ['kategori' => $kategori, 'jumlahBarang' => 0]);
	}

	public function simpan(Request $request)
	{
        $this->validate($request, [
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'ukuran' => 'required',
            'foto' => 'required',
        ]);

		$foto = time().'.'.$request->foto->extension();

		$kategori = Kategori::find($request->id_kategori);
		$nama = $kategori->nama;

		$words = explode(' ', $nama);
		$abbreviation = '';

		foreach ($words as $word) {
			$abbreviation .= strtoupper($word[0]);
		}

		$barang = Barang::where('kode_barang', 'LIKE', $abbreviation.'%')->orderBy('kode_barang', 'desc')->first();

		if ($barang) {
			$lastCode = substr($barang->kode_barang, -5); // Extract the numeric portion from the last kode_barang
			$newCodeNumber = (int) $lastCode + 1; // Increment the numeric portion by 1
			$newCode = $abbreviation . str_pad($newCodeNumber, 5, '0', STR_PAD_LEFT); // Combine the abbreviation and new numeric portion with leading zeros if necessary
		} else {
			$newCode = $abbreviation . '00001'; // If no previous record found, start with '00001'
		}

		$data = [
			'kode_barang' => $newCode,
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

		$kategori = Kategori::find($request->id_kategori);
		$nama = $kategori->nama;

		$words = explode(' ', $nama);
		$abbreviation = '';

		foreach ($words as $word) {
			$abbreviation .= strtoupper($word[0]);
		}

		$barang = Barang::find($id);
		$lastCode = substr($barang->kode_barang, 0, -5);
		
		if ($abbreviation == $lastCode) {
			$kode_barang = $barang->kode_barang;
		} else {
			$last_kode_barang = Barang::where('kode_barang', 'LIKE', $abbreviation.'%')->orderBy('kode_barang', 'desc')->first();

			if($last_kode_barang){
				$lastCode = substr($last_kode_barang->kode_barang, -5); // Extract the numeric portion from the last kode_barang
				$newCodeNumber = (int) $lastCode + 1; // Increment the numeric portion by 1
				$kode_barang = $abbreviation . str_pad($newCodeNumber, 5, '0', STR_PAD_LEFT); // Combine the abbreviation and new numeric portion with leading zeros if necessary
			} else {
				$kode_barang = $abbreviation . '00001';
			}
		}
        
		if ($request->foto != null) {

			$foto = time().'.'.$request->foto->extension();

			$data = [
				'nama_barang' => $request->nama_barang,
				'id_kategori' => $request->id_kategori,
				'harga' => $request->harga,
				'jumlah' => $request->jumlah,
				'ukuran' => $request->ukuran,
				'foto' => $foto,
				'kode_barang' => $kode_barang // Append 'kode_barang' to the data array
			];

			$request->foto->move(public_path('foto_product'), $foto);

		} else {

			$data = [
				'nama_barang' => $request->nama_barang,
				'id_kategori' => $request->id_kategori,
				'harga' => $request->harga,
				'jumlah' => $request->jumlah,
				'ukuran' => $request->ukuran,
				'kode_barang' => $kode_barang // Append 'kode_barang' to the data array
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

	public function getByCategory($category) {
        $barang = Barang::with('kategori')->where('id_kategori', $category)->get();
        
        return response()->json(['barang' => $barang]);
    }
}
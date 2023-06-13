<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Kategori;

class LandingPageController extends Controller
{
    public function index() 
    {
        $barang = Barang::all();
        $kategori = Kategori::all();

        return view("landing.index", ["barang" => $barang, "kategori" => $kategori ]);
    }

    public function detail(Barang $barang) 
    {
        return view("customer.details", ['barang' => $barang]);
    }

    public function category(Kategori $kategori) 
    {
        return view("customer.category", [
            "kategori" => $kategori->nama,
            "barang" => $kategori->barang
        ]);
    }

    public function beli(Barang $barang, Request $request)
    {
        // Validasi request sesuai kebutuhan
        $this->validate($request, [
            'jumlah' => 'required|integer|min:1'
        ]);

        $jumlahPembelian = $request->input('jumlah');

        // Mengurangi stok barang
            $barang->jumlah -= $jumlahPembelian;
            $barang->save();


}
}

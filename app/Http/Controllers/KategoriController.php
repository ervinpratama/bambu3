<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class KategoriController extends Controller
{
	public function index()
	{
		$kategori = Kategori::get();

		return view('kategori/index', ['kategori' => $kategori]);
	}

	public function tambah()
	{
		return view('kategori.form');
	}

	public function simpan(Request $request)
	{
        $this->validate($request, [
            'nama' => 'required',
            'foto' => 'required',
        ]);

        $foto = time().'.'.$request->foto->extension();

		Kategori::create([
			'nama' => $request->nama,
			'foto' => $foto
		]);

		// Public Folder
        $request->foto->move(public_path('foto_kategori'), $foto);

		return redirect()->route('kategori');
	}

	public function edit($id)
	{
		$kategori = Kategori::find($id);

		return view('kategori.form', ['kategori' => $kategori]);
	}

	public function update($id, Request $request)
	{

        $this->validate($request, [
            'nama' => 'required',
        ]);

		if($request->foto != null) {

			$foto = time().'.'.$request->foto->extension();

			Kategori::find($id)->update([
				'nama' => $request->nama,
				'foto' => $foto
			]);

			// Public Folder
			$request->foto->move(public_path('foto_kategori'), $foto);

		} else {
			Kategori::find($id)->update(['nama' => $request->nama]);
		}

		return redirect()->route('kategori');
	}

    public function hapus($id)
    {
        Kategori::find($id)->delete();

        return redirect()->route('kategori');
    }
}

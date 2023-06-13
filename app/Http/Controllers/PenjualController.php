<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PenjualController extends Controller
{
    public function index()
    {
        $penjual = User::where('level', 'Penjual')->get();

        return view('penjual.index', ['penjual' => $penjual]);
    }

    public function tambah()
    {
        return view('penjual.form');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

		User::create([
			'nama' => $request->nama,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'level' => 'Penjual'
		]);

        return redirect('penjual');
    }

    public function edit($id)
    {
        $penjual = User::find($id);

        return view('penjual.form', ['penjual' => $penjual]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
        ]);

		User::find($id)->update([
			'nama' => $request->nama,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

        return redirect('penjual');
    }

    public function hapus($id)
	{
		User::find($id)->delete();

		return redirect()->route('penjual');
	}
}

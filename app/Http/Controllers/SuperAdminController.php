<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        $superadmin = User::where('level', 'Super Admin')->get();

        return view('superadmin.index', ['superadmin' => $superadmin]);
    }

    public function tambah()
    {
        return view('superadmin.form');
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
			'level' => 'Super Admin'
		]);

        return redirect('superadmin');
    }

    public function edit($id)
    {
        $superadmin = User::find($id);

        return view('superadmin.form', ['superadmin' => $superadmin]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
        ]);

		User::find($id)->update([
			'nama' => $request->nama,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

        return redirect('superadmin');
    }

    public function hapus($id)
	{
		User::find($id)->delete();

		return redirect()->route('superadmin');
	}
}

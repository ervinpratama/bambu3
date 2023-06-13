<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Barang;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('12345'),
            'level' => 'Super Admin'
        ]);

        User::create([
            'nama' => 'Customer',
            'email' => 'test@mail.com',
            'password' => Hash::make('12345'),
            'level' => 'Pembeli'
        ]);

        User::create([
            'nama' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345'),
            'level' => 'Penjual'
        ]);

        Kategori::create([
            'nama' => 'Kategori 1',
            'foto' => ''
        ]);

        Kategori::create([
            'nama' => 'Kategori 2',
            'foto' => ''
        ]);

        Barang::create([
            'kode_barang' => 'B001',
			'nama_barang' => 'Barang 1',
			'id_kategori' => '1',
			'harga' => 10000,
			'jumlah' => 100,
			'foto' => ''
        ]);

        Barang::create([
            'kode_barang' => 'B002',
			'nama_barang' => 'Barang 2',
			'id_kategori' => '2',
			'harga' => 10000,
			'jumlah' => 100,
			'foto' => ''
        ]);
    }
}

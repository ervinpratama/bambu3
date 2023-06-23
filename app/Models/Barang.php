<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
	use HasFactory;

	protected $table = 'barang';

	protected $fillable = ['kode_barang', 'nama_barang', 'id_kategori', 'harga', 'jumlah', 'ukuran', 'foto'];

	// protected $appends = ['kode_barang'];

	public function kategori()
	{
		return $this->belongsTo(Kategori::class, 'id_kategori');
	}

	public function transactions()
	{
		return $this->belongsToMany(Transactions::class)->withPivot('jumlah');
	}

	// public function getKodeBarangAttribute()
    // {
    //     $kategori = $this->kategori->nama_kategori;
    //     $nomorUrut = $this->id;

    //     return strtoupper(substr($kategori, 0, 3)) . $nomorUrut;
    // }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $carts = Cart::where('user_id', Auth::user()->id)
                        ->join('barang', 'barang.id', '=', 'carts.barang_id')
                        ->get();

        return view('customer.cart', ['carts' => $carts]);
    }

    public function add(Barang $barang) {

        $item = Cart::where('barang_id', $barang->id)->first();
        
        if(!$item) {
            Cart::create([
                'user_id' => Auth::user()->id,
                'barang_id' => $barang->id,
                'qty' => 1,
                'price' => $barang->harga
            ]);

            return redirect('cart');
        } else {
            Cart::where('user_id', Auth::user()->id)->where('barang_id', $barang->id)->update([
                'qty' => $item->qty + 1,
                'price' => $barang->harga
            ]);

            return redirect('cart');
        }
    }

    public function remove(Barang $barang) {
        $item = Cart::where('barang_id', $barang->id)->first();

        if($item->qty === 1) {
            Cart::where('user_id', Auth::user()->id)->where('barang_id', $barang->id)->delete();

            return redirect('cart'); 
        } else {

            Cart::where('user_id', Auth::user()->id)->where('barang_id', $barang->id)->update([
                'qty' => $item->qty - 1,
                'price' => $barang->harga
            ]);
            
            return redirect('cart');
        }
    }
}

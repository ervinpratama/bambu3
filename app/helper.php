<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

function cart_count()
{
    $cart = Cart::where('user_id', Auth::user()->id)->get();

    $count = count($cart);

    return $count;
}

function total_belanja()
{
    $carts = Cart::where('user_id', Auth::user()->id)
                        ->join('barang', 'barang.id', '=', 'carts.barang_id')
                        ->get();

    $total = 0;

    foreach($carts as $item){
        $total += $item->qty * $item->harga;
    }

    return $total;
}

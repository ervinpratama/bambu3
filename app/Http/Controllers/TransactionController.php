<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\BuktiTransfer;
use App\Models\Reject;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use PDF;

use App\Models\Barang;

class TransactionController extends Controller
{
    public function index(Request $request)
{
    $status = $request->input('status');

    if(isset($status)){
            $transactions = Transaction::select('transactions.id', 'transactions.*', 'users.nama', 'bukti_transfer.status', 'bukti_transfer.gambar')
                            ->join('users', 'users.id', '=', 'transactions.user_id')
                            ->leftJoin('bukti_transfer', 'transactions.id', '=', 'bukti_transfer.transaction_id')
                            ->where('bukti_transfer.status', '=', $status)
                            ->orderBy('transactions.id', 'DESC')
                            ->get();
        } else {
        $transactions = Transaction::
                select('transactions.id', 'transactions.*' ,'users.nama')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->orderBy('transactions.id', 'DESC')
                ->get();
        }

        $transaction_id = [];

        foreach($transactions as $data){
            array_push($transaction_id, $data->id);
        }

        $transaction_detail = TransactionDetail::join('barang', 'barang.id', '=', 'transaction_detail.barang_id')
        ->whereIn('transaction_detail.transaction_id', $transaction_id)->get();

        return view('transaction.index', ['transactions' => $transactions, 'details' => $transaction_detail]);
    }

    public function history()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)
                                    ->select('transactions.id', 'transactions.*', 'users.nama', 'barang.nama_barang')
                                    ->join('users', 'users.id', '=', 'transactions.user_id')
                                    ->join('transaction_detail', 'transaction_detail.transaction_id', '=', 'transactions.id')
                                    ->join('barang', 'barang.id', '=', 'transaction_detail.barang_id')
                                    ->orderBy('transactions.id', 'DESC')
                                    ->limit(1)
                                    ->get();
        
        $transaction_id = [];

        foreach($transactions as $data){
            array_push($transaction_id, $data->id);
        }

        $transaction_detail = TransactionDetail::join('barang', 'barang.id', '=', 'transaction_detail.barang_id')
        ->whereIn('transaction_detail.transaction_id', $transaction_id)->get();

        return view('customer.history', ['history' => $transactions, 'details' => $transaction_detail]);
    }

    public function checkout()
    {
        return view('customer.checkout');
    }

    public function proses(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        
        $carts = Cart::where('user_id', Auth::user()->id)
        ->join('barang', 'barang.id', '=', 'carts.barang_id')
        ->get();
        
        if(count($carts) == 0) {
            return redirect('transaction/history');
        }
        
        $total = 0;
        
        foreach($carts as $item) {
            $total += $item->qty * $item->price;
        }
        $orderID = 'ORDER-'.date('Ymd').'-'.Auth::user()->id;
        $transaction = Transaction::create([
            'order_id' => $orderID,
            'user_id' => Auth::user()->id,
            'total' => $total,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'provinsi' => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan' => $request->kecamatan,
            'desa_kelurahan' => $request->desa_kelurahan,
            'kodepos' => $request->kodepos,
            'transaction_date' => date('Y-m-d') 
        ]);    
        
        $transaction_detail = [];

        foreach($carts as $item) {
            array_push($transaction_detail, [
                'transaction_id' => $transaction->id,
                'barang_id' => $item->barang_id,
                'qty' => $item->qty,
                'price' => $item->price
            ]);
        }

        $detail = TransactionDetail::insert($transaction_detail);

        if($detail) {

            // Menghapus cart setelah checkout
            Cart::where('user_id', Auth::user()->id)->delete();

            return redirect('/transaction/history');
        }
    }

    public function upload_bukti_transfer($id = null)
    {
        $transaction = Transaction::find($id);
        return view('customer.bukti-transfer', ['transaction' => $transaction]);
    }

    public function proses_upload(Request $request)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->bukti->extension();

        BuktiTransfer::create([
            'transaction_id' => $request->order_id,
            'gambar' => $imageName,
            'status' => 'pending'
        ]);

        // Public Folder
        $request->bukti->move(public_path('bukti_transfer'), $imageName);
       
        return redirect('/transaction/history');
    }

    public function reject($id = null)
    {
        $transaction = Transaction::find($id);
        return view('customer.reject', ['transaction' => $transaction]);
    }

    public function store_reject(Request $request)
    {
        $files = $request->file('images');
        $filename = "";
        foreach ($files as $file) {
            $file->move('images/reject',$file->getClientOriginalName());
            $filename .= "|".$file->getClientOriginalName();
        }

        Reject::create([
            'transaction_id' => $request->id,
            'images' => $filename,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);
       
        return redirect('/transaction/history');
    }

    public function accept($id)
    {
        BuktiTransfer::where('transaction_id', $id)->update([
            'status' => 'acc'
        ]);
        return redirect('transaction');
    }

    public function kirim($id)
    {
        BuktiTransfer::where('transaction_id', $id)->update([
            'status' => 'dikirim'
        ]);
        $dataCart = TransactionDetail::where('transaction_id',$id)->get();
        // Mengurangi stok barang
        foreach($dataCart as $item) {
            $barang = Barang::find($item->barang_id);
            $barang->jumlah -= $item->qty;
            $barang->save();
        }
        return redirect('transaction');
    }

    public function terima_pesanan($id)
    {
        BuktiTransfer::where('transaction_id', $id)->update([
            'status' => 'selesai'
        ]);
        return redirect('transaction/history');
    }

    public function batalkan_pesanan($id)
    {
        BuktiTransfer::where('transaction_id', $id)->update([
            'status' => 'dibatalkan'
        ]);
        return redirect('transaction/history');
    }

    public function export_pdf(Request $request)
    {
    
        $daterange = explode(' - ', $request->daterange);
        $tgl_mulai = date('Y-m-d', strtotime($daterange[0]));
        $tgl_selesai = date('Y-m-d', strtotime($daterange[1]));

        $transactions = TransactionDetail::
        select('transactions.id', 'transactions.order_id', 'transactions.no_hp', 'transactions.alamat', 'transactions.total', 'transactions.transaction_date', 'transaction_detail.qty', 'transaction_detail.price', 'barang.nama_barang', 'bukti_transfer.status')
        ->join('transactions', 'transactions.id', '=', 'transaction_detail.transaction_id')
        ->join('barang', 'barang.id', '=', 'transaction_detail.barang_id')
        ->leftJoin('bukti_transfer', 'transactions.id', '=', 'bukti_transfer.transaction_id')
        ->where('transactions.transaction_date', '>=', $tgl_mulai)
        ->where('transactions.transaction_date', '<=', $tgl_selesai)
        ->where('bukti_transfer.status', '=', 'acc')
        ->get();


        // return dd($transactions);

        $pdf = PDF::loadView('transaction.exportPDF', 
            ['list' => $transactions], 
        )->setPaper('a4', 'landscape');;


        return $pdf->stream('itsolutionstuff.pdf');
    }

}

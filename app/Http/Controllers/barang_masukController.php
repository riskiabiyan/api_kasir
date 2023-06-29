<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barang_masuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class barang_masukController extends Controller
{
    public function insert_barang_masuk(Request $request){
       $barang_id = $request->barang_id;
       $supplier_id = $request->supplier_id;
       $jumlahMasuk = $request->jumlahMasuk;

       $stokLama = Barang::select('barangs.jumlahTotal')
       ->where('barangs.id', $barang_id)
       ->get();
       
       $stokLama = $stokLama->__toString();
       $stokLama = preg_replace('/[^0-9]/', '', $stokLama);
       $stokBaru = ((int)$stokLama + (int)$jumlahMasuk);

       $updateStok = Barang::where('barangs.id', $barang_id)
       ->update([
        'jumlahTotal' => $stokBaru
       ]);

       $insert = new Barang_masuk;
       $insert->barang_id = $barang_id;
       $insert->supplier_id = $supplier_id;
       $insert->jumlahMasuk = $jumlahMasuk;
       $insert->save();

       if($updateStok){
        return response([
            'status' => 'OK',
            'message' => 'Stok berhasil ditambahkan',
            'data' => $insert
        ], 200);
       }else{
        return response([
            'status' => 'Failed',
            'message' => 'Data gagal ditambahkan'
        ], 500);
       }
    }
}

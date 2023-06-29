<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class keranjangController extends Controller
{
    public function insert_keranjang(Request $request){
        $keranjang = new Keranjang;
        $keranjang->barang_id = $request->barang_id;
        $keranjang->kode_keranjang = $request->kode_keranjang;
        $keranjang->save();

        return response([
            'status' => 'OK',
            'message' => 'Data berhasil disimpan',
            'data' => $keranjang
        ], 200);
    }

    public function get_kode_keranjang($kode_keranjang){
        $get_keranjang = Keranjang::where('kode_keranjang', $kode_keranjang)
        ->get('id');

        return response([
            'status' => 'OK',
            'message' => 'Data berhasil didapatkan',
            'data' => $get_keranjang
        ], 200);
    }
}

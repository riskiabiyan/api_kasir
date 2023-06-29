<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class barangController extends Controller
{
    public function insert_barang(Request $request){
        $insert_barang = new Barang;
        $insert_barang->kategori_id = $request->kategori_id;
        $insert_barang->namaBarang = $request->namaBarang;
        $insert_barang->jumlahTotal = $request->jumlahTotal;
        $insert_barang->hargaJual = $request->hargaJual;
        $insert_barang->hargaModal = $request->hargaModal;
        $insert_barang->status_barang = $request->status_barang;
        $insert_barang->save();

        return response([
            'status' => 'OK',
            'message' => 'Data berhasil disimpan',
            'data' => $insert_barang
        ], 200);
    }

    public function get_list_barang(){
        $get_list_barang = Barang::join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
        ->where('barangs.status_barang', '=' , 'aktif')
        ->orderBy('barangs.namaBarang', 'asc')
        ->get(['barangs.namaBarang', 
        'barangs.jumlahTotal', 'barangs.hargaJual', 'kategoris.namaKategori']);
        
        return response([
            'data' => $get_list_barang
        ], 200);
    }

    public function delete_barang($id){
        $cek = Barang::firstwhere('barangs.id', $id);

        if($cek){
            $delete = Barang::where('barangs.id', $id)->delete();

            return response([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus'
            ], 200);
        }else{
            return response([
                'status' => 'Not Found',
                'message' => 'ID barang tidak ditemukan'
            ], 404);
        }
    }

    public function update_barang(Request $request){
        $id = $request->id;
        $kategori_id = $request->kategori_id;
        $namaBarang = $request->namaBarang;
        $jumlahTotal = $request->jumlahTotal;
        $hargaJual = $request->hargaJual;
        $hargaModal = $request->hargaModal;
        $status_barang = $request->status_barang;

        $update = Barang::where('id', $id)
        ->update([
            'kategori_id' => $kategori_id,
            'namaBarang' => $namaBarang,
            'jumlahTotal' => $jumlahTotal,
            'hargaJual' => $hargaJual,
            'hargaModal' => $hargaModal,
            'status_barang' => $status_barang
        ]);

        if($update){
            return response([
                'status' => 'success',
                'message' => 'Data berhasil diubah'
            ], 200);
        }else{
            return response([
                'status' => 'failed',
                'message' => 'Data gagal diubah'
            ], 500);
        }
    }


}

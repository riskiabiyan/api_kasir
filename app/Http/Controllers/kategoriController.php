<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Kategori;

class kategoriController extends Controller
{
    public function insert_kategori(Request $request){
        $insert_kategori = new Kategori;

        $insert_kategori->namaKategori = $request->namaKategori;
        $insert_kategori->save();

        return response([
            'status' => 'OK',
            'message' => 'Data berhasil disimpan',
            'data' => $insert_kategori
        ], 200);
    }

    public function get_kategori(){
        return response()->json([
            'data' => Kategori::all()
        ]);
    }

    public function update_kategori(Request $request){
        $id_kategori = $request->id;
        $namaKategori = $request->namaKategori;

        $update = Kategori::where('id', $id_kategori)
        ->update(['namaKategori' => $namaKategori]);

        if ($update){
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

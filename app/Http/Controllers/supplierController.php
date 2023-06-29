<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class supplierController extends Controller
{
    public function insert_supplier(Request $request){
        $insert_supplier = new Supplier;
        $insert_supplier->namaSupplier = $request->namaSupplier;
        $insert_supplier->noHP = $request->noHP;
        $insert_supplier->save();

        return response([
            'status' => 'OK',
            'message' => 'Supplier berhasil ditambah',
            'data' => $insert_supplier
        ], 200);
    }
}

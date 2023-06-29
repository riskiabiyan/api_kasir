<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function login(Request $request){
        $role = $request->role;
        $email = $request->email;
        $password = $request->password;

        $user_login = User::where('role', $role)
        ->where('email', $email)
        ->where('password', $password)
        ->exists();

        $user_id = User::where('email', $email)
        ->where('password', $password)
        ->get();

        if($user_login){
           
            return response([
                'status' => 'OK',
                'message' => 'Login berhasil',
                'data' => $user_id
            ], 200);
        }else{
            return response([
                'status' => 'Failed',
                'message' => 'Login gagal',
                'data' => $user_login
            ], 404);
        }
    }

    public function register(Request $request){
        $register = new User;
        $register->namaLengkap = $request->namaLengkap;
        $register->email = $request->email;
        $register->password = $request->password;
        $register->role = $request->role;
        $register->save();

        return response([
            'status' => 'OK',
            'message' => 'User berhasil ditambahkan',
            'data' => $register
        ], 200);
    }

    /// Admin
    public function get_user(Request $request){
        $get_users = User::where('role', 'kasir')
        ->get();

        return response([
            'status' => 'OK',
            'data' => $get_users
        ],200);
    }

    public function delete_user($id){
        $cek = User::firstwhere('users.id', $id);

        if($cek){
            $delete = User::where('users.id', $id)
            ->delete();

            return response([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus'
            ], 200);
        }else{
            return response([
                'status' => 'Not found',
                'message' => 'ID user tidak ditemukan'
            ], 404);
        }
    }
}

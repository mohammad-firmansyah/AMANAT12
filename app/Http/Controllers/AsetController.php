<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AsetController extends Controller
{
    public function dashboard(){
        // dd(session("token"));
        try {
            $decrypted = Crypt::decryptString(session("token"));
        } catch (DecryptException $e) {
            dd($e);
        }
        $user = DB::table("users")->where("user_id",$decrypted)->first();

        $nama = $user->username;
        $jabatan = DB::table("hak_akses")->where("hak_akses_id",$user->hak_akses_id)->first()->hak_akses_desc;
        $title = "hi";
        // dd($jabatan);
        $totalm = 10;
        return view("page.home",compact(["nama","title","jabatan","totalm"]));
    }
}

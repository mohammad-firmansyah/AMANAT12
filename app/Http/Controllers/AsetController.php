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
        $title = "Dashboard | Aplikasi Aset Manajemen N12";
        
        // aset tipe
        $aset_tipe = DB::table("aset_tipe")->get();
        $jumlah_aset_tipe =[];
        foreach ($aset_tipe as $key => $value) {
            array_push($jumlah_aset_tipe,count(DB::table("data_aset")->where("aset_tipe",$value->aset_tipe_id)->get()));  
        }
        // end tipe aset


        // jenis aset
        $aset_jenis = DB::table("aset_jenis")->get();
        $jumlah_aset_jenis = [];
        foreach ($aset_jenis as $key => $value) {
            array_push($jumlah_aset_jenis, count(DB::table("data_aset")->where("aset_jenis", $value->aset_jenis_id)->get()));
        }
        // end jenis aset

        // kondisi aset
        $aset_kondisi = DB::table("aset_kondisi")->get();
        $jumlah_aset_kondisi = [];
        foreach ($aset_kondisi as $key => $value) {
            array_push($jumlah_aset_kondisi, count(DB::table("data_aset")->where("aset_kondisi", $value->aset_kondisi_id)->get()));
        }
        // end jenis aset
       
        // kode aset
        $aset_kode = DB::table("aset_kode")->get();
        $jumlah_aset_kode = [];
        foreach ($aset_kode as $key => $value) {
            array_push($jumlah_aset_kode, count(DB::table("data_aset")->where("aset_kode", $value->aset_kode_id)->get()));
        }
        // end kode aset
       

        // status posisi
        $status_posisi = DB::table("status_posisi")->get();
        $jumlah_sp = [];
        foreach ($status_posisi as $key => $value) {
            array_push($jumlah_sp, count(DB::table("data_aset")->where("status_posisi", $value->sp_id)->get()));
        }
        // end status posisi

        return view("page.home",compact(["nama","title","jabatan","aset_tipe","jumlah_aset_tipe", "aset_jenis","jumlah_aset_jenis", "aset_kondisi","jumlah_aset_kondisi", "aset_kode","jumlah_aset_kode", "status_posisi", "jumlah_sp"]));
    }
}

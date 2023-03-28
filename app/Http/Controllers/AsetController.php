<?php

namespace App\Http\Controllers;

use App\Helpers\User;
use App\Helpers\Aset;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DateTime;

class AsetController extends Controller
{
    public function dashboard(){

        $user = User::get_user_from_token();

        $nama = $user->username;
        $jabatan = DB::table("hak_akses")->where("hak_akses_id",$user->hak_akses_id)->first()->hak_akses_desc;
        $title = "Dashboard | Aplikasi Aset Manajemen N12";

        // aset tipe
        $aset_tipe = DB::table("aset_tipe")->get();
        $jumlah_aset_tipe =[];
        foreach ($aset_tipe as $key => $value) {
            array_push($jumlah_aset_tipe,count(DB::table("data_aset")->where("aset_tipe",$value->aset_tipe_id)->where("unit_id",$user->unit_id)->get()));
        }
        // end tipe aset


        // jenis aset
        $aset_jenis = DB::table("aset_jenis")->get();
        $jumlah_aset_jenis = [];
        foreach ($aset_jenis as $key => $value) {
            array_push($jumlah_aset_jenis, count(DB::table("data_aset")->where("aset_jenis", $value->aset_jenis_id)->where("unit_id", $user->unit_id)->get()));
        }
        // end jenis aset

        // kondisi aset
        $aset_kondisi = DB::table("aset_kondisi")->get();
        $jumlah_aset_kondisi = [];
        foreach ($aset_kondisi as $key => $value) {
            array_push($jumlah_aset_kondisi, count(DB::table("data_aset")->where("aset_kondisi", $value->aset_kondisi_id)->where("unit_id", $user->unit_id)->get()));
        }
        // end jenis aset

        // kode aset
        $aset_kode = DB::table("aset_kode")->get();
        $jumlah_aset_kode = [];
        foreach ($aset_kode as $key => $value) {
            array_push($jumlah_aset_kode, count(DB::table("data_aset")->where("aset_kode", $value->aset_kode_id)->where("unit_id", $user->unit_id)->get()));
        }
        // end kode aset


        // status posisi
        $status_posisi = DB::table("status_posisi")->get();
        $jumlah_sp = [];
        foreach ($status_posisi as $key => $value) {
            array_push($jumlah_sp, count(DB::table("data_aset")->where("unit_id", $user->unit_id)->where("status_posisi", $value->sp_id)->get()));
        }
        // end status posisi

        return view("page.home",compact(["nama","title","jabatan","aset_tipe","jumlah_aset_tipe", "aset_jenis","jumlah_aset_jenis", "aset_kondisi","jumlah_aset_kondisi", "aset_kode","jumlah_aset_kode", "status_posisi", "jumlah_sp"]));
    }

    public function index(){
        $user = User::get_user_from_token();

        // dd($user);

        $nama = $user->username;
        $jabatan = DB::table("hak_akses")->where("hak_akses_id", $user->hak_akses_id)->first()->hak_akses_desc;
        $title = "Semua Aset";

        $unit = DB::table("unit")->where("unit_id", $user->unit_id)->first();

        if ($unit->unit_tipe != 1) {
            if ($user->hak_akses_id > 5) {
                if ($user->sub_unit_id == 1) {

                    $aset = DB::table("data_aset")->where("unit_id", $unit["unit_id"])->Where("aset_sub_unit", $user->sub_unit_id)->orderByDesc("aset_id")->get();
                } else if ($user->sub_unit_id == 2) {
                    $aset = DB::table("data_aset")->where("unit_id", $unit->unit_id)->Where("afdeling_id", $user->afdeling_id)->orderByDesc("aset_id")->get();
                } else {
                    $aset = DB::table("data_aset")->where("unit_id", $unit->unit_id)->Where("aset_sub_unit", $user->sub_unit_id)->orderByDesc("aset_id")->get();
                }
            } else {
                $aset = DB::table("data_aset")->where("unit_id", $unit->unit_id)->orderByDesc("aset_id")->get();
            }
        } else {
            $aset = DB::table("data_aset")->orderByDesc("aset_id")->get();
        }



        foreach ($aset as $k) {
            $k->status_posisi_id = $k->status_posisi;

            $aset_tipe = DB::table("aset_tipe")->where('aset_tipe_id', $k->aset_tipe)->first();
            $aset_jenis = DB::table("aset_jenis")->where('aset_jenis_id', $k->aset_jenis)->first();
            $unit = DB::table("unit")->where('unit_id', $k->unit_id)->first();
            $sub_unit = DB::table("sub_unit")->where('sub_unit_id', $k->aset_sub_unit)->first();
            $afdelling = DB::table("afdeling")->where('afdeling_id', $k->afdeling_id)->first();
            $tipe_aset = DB::table("aset_kondisi")->where('aset_kondisi_id', $k->aset_kondisi)->first();
            $aset_kode = DB::table("aset_kode")->where('aset_kode_id', $k->aset_kode)->first();
            $aset_kondisi = DB::table("aset_kondisi")->where('aset_kondisi_id', $k->aset_kondisi)->first();
            $status_posisi = DB::table("status_posisi")->where('sp_id', $k->status_posisi)->first();

            $k->nilai_oleh = Aset::toRupiah($k->nilai_oleh);
            $k->sub_unit_id = $sub_unit->sub_unit_desc;
            $k->aset_tipe = $aset_tipe->aset_tipe_desc;
            $k->aset_jenis = $aset_jenis->aset_jenis_desc;
            $k->aset_kondisi = $aset_kondisi->aset_kondisi_desc;
            $k->nomor_sap = DB::table("sap")->where("sap_id",$k->nomor_sap)->first();
            if (!$k->nomor_sap){
                $k->nomor_sap = "Nomor SAP salah";
            } else {
                $k->nomor_sap = $k->nomor_sap->sap_desc;
            }

            // aset kode
            $aset_kode_temp = "";
            if ($aset_kode->aset_jenis == 1) {
                $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_desc;
            } else if ($aset_kode->aset_jenis == 2) {
                $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
            } else {
                $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
            }


            $k->aset_kode = $aset_kode_temp;
            $k->unit_id = $unit->unit_desc;
            if (isset($afdelling->afdeling_desc)) {
                $k->afdeling_id = $afdelling->afdeling_desc;
            } else {
                $k->afdeling_id = "-";
            }

            $k->status_posisi_id = $k->status_posisi;
            $k->status_posisi = $status_posisi->sp_desc;
            $now = date_create()->format('Y-m-d H:i:s');
            $date2 = new DateTime($now);
            $date = new DateTime($k->tgl_oleh);

            $interval_m = $date->diff($date2)->m;
            $interval_y = $date->diff($date2)->y;
            $umur_ekonomis_in_month = ($k->masa_susut * 12) - (($interval_y * 12) + $interval_m);

            $k->umur_ekonomis_in_month = $umur_ekonomis_in_month;
        }



        return view("page.aset.aset",compact(["nama","jabatan","title","aset"]));

    }

    public function edit($id){

        $user = User::get_user_from_token();

        $nama = $user->username;
        $jabatan = DB::table("hak_akses")->where("hak_akses_id", $user->hak_akses_id)->first()->hak_akses_desc;
        $title = "Edit";


        $aset = DB::table("data_aset")->where("aset_id",$id)->first();
        $all_tipe = DB::table("aset_tipe")->get();
        $all_jenis = DB::table("aset_jenis")->get();
        $all_kode = DB::table("aset_kode")->get();
        $all_sap = DB::table("sap")->get();
        $all_kondisi = DB::table("aset_kondisi")->get();
        $all_sistem_tanam = DB::table("sistem_tanam")->get();

        $all_kode_tanaman = array();
        $all_kode_nontan = array();
        $all_kode_kayu = array();
        foreach ($all_kode as $key => $value) {
            if($value->aset_jenis == 1) {
                array_push($all_kode_tanaman,$value);
            }

            else if ($value->aset_jenis == 2) {
                array_push($all_kode_nontan,$value);
            } else{
                array_push($all_kode_kayu,$value);
            }
        }
        // $aset->aset_jenis = DB::table("aset_jenis")->where("aset_jenis_id",$aset->aset_jenis)->first()->aset_jenis_desc;
        // $aset->aset_kondisi = DB::table("aset_kondisi")->where("aset_kondisi_id",$aset->aset_kondisi)->first()->aset_kondisi_desc;
        // $aset->aset_tipe = DB::table("aset_tipe")->where("aset_tipe_id",$aset->aset_tipe)->first()->aset_tipe_desc;
        $aset->unit_id = DB::table("unit")->where('unit_id', $aset->unit_id)->first()->unit_desc;
        $aset->aset_sub_unit = DB::table("sub_unit")->where('sub_unit_id', $aset->aset_sub_unit)->first()->sub_unit_desc;

        $aset->afdeling_id = DB::table("afdeling")->where('afdeling_id', $aset->afdeling_id)->first()->afdeling_desc;

        // $aset_kode = DB::table("aset_kode")->where('aset_kode_id', $aset->aset_kode)->first();
        // aset kode
        // $aset_kode_temp = "";
        // if ($aset_kode->aset_jenis == 1) {
        //     $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_desc;
        // } else if ($aset_kode->aset_jenis == 2) {
        //     $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
        // } else {
        //     $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
        // }

        // $aset->aset_kode = $aset_kode_temp;

        $aset->status_posisi = DB::table("status_posisi")->where('sp_id', $aset->status_posisi)->first()->sp_desc;

        if (!isset($aset->afdeling_id)) {
            $aset->afdeling_id = "-";
        }

        $now = date_create()->format('Y-m-d H:i:s');
        $date2 = new DateTime($now);
        $date = new DateTime($aset->tgl_oleh);

        $interval_m = $date->diff($date2)->m;
        $interval_y = $date->diff($date2)->y;
        $umur_ekonomis_in_month = ($aset->masa_susut * 12) - (($interval_y * 12) + $interval_m);

        $aset->umur_ekonomis = Aset::toUmurEkonomis($umur_ekonomis_in_month);
        $aset->nilai_oleh = Aset::toRupiah($aset->nilai_oleh);
        $aset->nilai_residu = Aset::toRupiah($aset->nilai_residu);
// dd($all_sistem_tanam);
        return view("page.aset.edit",compact(["aset","title","nama","jabatan",'all_sistem_tanam','all_kode_tanaman','all_kode_nontan','all_kode_kayu','all_tipe','all_jenis','all_kode','all_sap','all_kondisi']));
    }
    public function detail($id){

        $user = User::get_user_from_token();

        $nama = $user->username;
        $jabatan = DB::table("hak_akses")->where("hak_akses_id", $user->hak_akses_id)->first()->hak_akses_desc;
        $title = "Detail";


        $aset = DB::table("data_aset")->where("aset_id",$id)->first();
        $aset->aset_jenis = DB::table("aset_jenis")->where("aset_jenis_id",$aset->aset_jenis)->first()->aset_jenis_desc;
        $aset->aset_kondisi = DB::table("aset_kondisi")->where("aset_kondisi_id",$aset->aset_kondisi)->first()->aset_kondisi_desc;
        $aset->aset_tipe = DB::table("aset_tipe")->where("aset_tipe_id",$aset->aset_tipe)->first()->aset_tipe_desc;
        $aset->unit_id = DB::table("unit")->where('unit_id', $aset->unit_id)->first()->unit_desc;
        $aset->aset_sub_unit = DB::table("sub_unit")->where('sub_unit_id', $aset->aset_sub_unit)->first()->sub_unit_desc;

        $aset->afdeling_id = DB::table("afdeling")->where('afdeling_id', $aset->afdeling_id)->first()->afdeling_desc;

        $aset_kode = DB::table("aset_kode")->where('aset_kode_id', $aset->aset_kode)->first();

        // aset kode
        $aset_kode_temp = "";
        if ($aset_kode->aset_jenis == 1) {
            $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_desc;
        } else if ($aset_kode->aset_jenis == 2) {
            $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
        } else {
            $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
        }

        $aset->aset_kode = $aset_kode_temp;

        $aset->status_posisi = DB::table("status_posisi")->where('sp_id', $aset->status_posisi)->first()->sp_desc;

        if (!isset($aset->afdeling_id)) {
            $aset->afdeling_id = "-";
        }

        $now = date_create()->format('Y-m-d H:i:s');
        $date2 = new DateTime($now);
        $date = new DateTime($aset->tgl_oleh);

        $interval_m = $date->diff($date2)->m;
        $interval_y = $date->diff($date2)->y;
        $umur_ekonomis_in_month = ($aset->masa_susut * 12) - (($interval_y * 12) + $interval_m);

        $aset->umur_ekonomis = Aset::toUmurEkonomis($umur_ekonomis_in_month);
        $aset->nilai_oleh = Aset::toRupiah($aset->nilai_oleh);
        $aset->nilai_residu = Aset::toRupiah($aset->nilai_residu);

        return view("page.aset.detail",compact(["aset","title","nama","jabatan"]));
    }
}

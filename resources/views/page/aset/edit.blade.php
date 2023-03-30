@extends('template.master')
@section('title', $title ?? '')
@section('nama', $nama ?? '')
@section('jabatan', $jabatan ?? '')



@section('pluginCSS')
<!-- third party css -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .hidden {
        display: none !important;
    }
</style>
<!-- third party css end -->
@endsection

@section('breadcump')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{!! url('dashboard') !!}">Home</a></li>
    <li class="breadcrumb-item "><a href="{!! url('aset') !!}">Aset</a></li>
    <li class="breadcrumb-item active">{{ $title }}</li>
</ol>
@endsection

@section('content')

<div class="row" >
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Data {{ $title }}</h4><br>

                <form action="{{url('aset/'.$aset->aset_id)}}" method="post" enctype="multipart/form-data">

                @csrf
                    <div class="row" id="row1">
                        <div class="col">

                            <div class="form-group">
                                <label for="aset_tipe">Tipe Aset</label>
                                <select class="form-control" id="aset_tipe" name="aset_tipe">
                                    @foreach($all_tipe as $aset_tipe)

                                    @if( $aset->aset_tipe == $aset_tipe->aset_tipe_id )
                                    <option value="{{$aset_tipe->aset_tipe_id}}" selected>{{$aset_tipe->aset_tipe_desc}}</option>
                                    @else
                                    <option value="{{$aset_tipe->aset_tipe_id}}">{{$aset_tipe->aset_tipe_desc}}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="aset_jenis">Aset Jenis</label>
                                <select class="form-control" id="aset_jenis" name="aset_jenis">
                                    @foreach($all_jenis as $aset_jenis)

                                    @if( $aset->aset_jenis == $aset_jenis->aset_jenis_id )
                                    <option value="{{$aset_jenis->aset_jenis_id}}" selected>{{$aset_jenis->aset_jenis_desc}}</option>
                                    @else
                                    <option value="{{$aset_jenis->aset_jenis_id}}">{{$aset_jenis->aset_jenis_desc}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="row2">
                        <div class="col">

                            <div class="form-group">
                                <label for="aset_kondisi">Kondisi Aset</label>
                                <select class="form-control" id="aset_kondisi" name="aset_kondisi">
                                    @foreach($all_kondisi as $aset_kondisi)


                                    @if( $aset->aset_kondisi == $aset_kondisi->aset_kondisi_id )
                                    <option value="{{$aset_kondisi->aset_kondisi_id}}" selected>{{$aset_kondisi->aset_kondisi_desc}}</option>
                                    @else
                                    <option value="{{$aset_kondisi->aset_kondisi_id}}">{{$aset_kondisi->aset_kondisi_desc}}</option>
                                    @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="aset_kode_tanaman">Kode Aset</label>
                                <select class="form-control" id="aset_kode_tanaman" name="aset_kode">
                                    @foreach($all_kode_tanaman as $aset_kode)
                                    <?php
                                    $aset_kode_temp = "";
                                    if ($aset_kode->aset_jenis == 2) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_desc;
                                    } else if ($aset_kode->aset_jenis == 1) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    } else {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    }


                                    ?>

                                    @if($aset->aset_kode == $aset_kode->aset_kode_id )
                                    <option value="{{$aset_kode->aset_kode_id}}" selected>

                                        {{$aset_kode_temp}}
                                    </option>
                                    @else
                                    <option value="{{$aset_kode->aset_kode_id}}">{{$aset_kode_temp}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <select class="form-control" id="aset_kode_nontan" name="aset_kode">
                                    @foreach($all_kode_nontan as $aset_kode)
                                    <?php
                                    $aset_kode_temp = "";
                                    if ($aset_kode->aset_jenis == 2) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_desc;
                                    } else if ($aset_kode->aset_jenis == 1) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    } else {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    }

                                    ?>

                                    @if( $aset->aset_kode == $aset_kode->aset_kode_id )
                                    <option value="{{$aset_kode->aset_kode_id}}" selected>

                                        {{$aset_kode_temp}}

                                    </option>
                                    @else
                                    <option value="{{$aset_kode->aset_kode_id}}">{{$aset_kode_temp}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <select class="form-control" id="aset_kode_kayu" name="aset_kode">
                                    @foreach($all_kode_kayu as $aset_kode)
                                    <?php
                                    $aset_kode_temp = "";
                                    if ($aset_kode->aset_jenis == 2) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_desc;
                                    } else if ($aset_kode->aset_jenis == 1) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    } else {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    }



                                    ?>

                                    @if( $aset->aset_kode == $aset_kode->aset_kode_id )
                                    <option value="{{$aset_kode->aset_kode_id}}" selected>

                                        {{$aset_kode_temp}}
                                    </option>
                                    @else
                                    <option value="{{$aset_kode->aset_kode_id}}">{{$aset_kode_temp}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

  <div class="row" id="alat_angkut_row">

                        <div class="col">
                            <label for="alat_angkut">Alat Pengangkutan</label>
                            <select name="alat_angkut" id="alat_angkut" class="form-control">
                                @foreach($all_alat_angkut as $alat_angkut)
                                <option value="{{$alat_angkut->ap_id}}">{{ $alat_angkut->ap_desc}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                      <div class="row" id="sistem_tanam_row">
                        <div class="col" id="sistem_tanam_col">

                            <div class="form-group">
                                <label for="sistem_tanam">Sistem Tanam</label>
                                <select class="form-control" id="sistem_tanam" name="sistem_tanam">
                                @foreach($all_sistem_tanam as $sistem_tanam)
                                    @if( $aset->sistem_tanam == $sistem_tanam->st_id )
                                    <option value="{{$sistem_tanam->st_id}}" selected>{{$sistem_tanam->st_desc}}</option>
                                    @else
                                    <option value="{{$sistem_tanam->st_id }}">{{$sistem_tanam->st_desc}}</option>
                                    @endif
                                @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="aset_jenis">Tahun Tanam</label>
                                <input name="tahun_tanam" type="text" class="form-control" id="tahun_tanam" placeholder="tahun tanam" value="{{$aset->tahun_tanam}}">
                            </div>
                        </div>
                    </div>

                    <div class="row" id="row3">

                        <div class="col">

                            <div class="form-group ">
                                <label for="unit">Unit</label>
                                <select class="form-control" id="unit" name="unit" disabled>
                                    <option>{{$aset->unit_id}}</option>
                                </select>

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="sub_unit">Sub Unit</label>
                                <select class="form-control" id="sub_unit" name="sub_unit" disabled>
                                    <option>{{$aset->aset_sub_unit}}</option>
                                </select>
                            </div>
                        </div>

                        @if($aset->aset_sub_unit == "Afdeling")
                        <div class="col">
                            <div class="form-group ">
                                <label for="afdeling">Afdeling</label>
                                <select class="form-control" id="afdeling" name="afdeling" disabled>
                                    <option>{{$aset->afdeling_id}}</option>
                                </select>

                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row" id="row4">

                        <div class="col">

                            <div class="form-group">

                                <label for="nomor_sap">Nomor SAP</label>
                                <select class="form-control" id="nomor_sap" name="nomor_sap">
                                    @foreach($all_sap as $sap)
                                    <option value="{{$sap->sap_id}}>">{{$sap->sap_desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="row5">
                        <div class="col">
                            <div class="form-group ">
                                <label for="exampleFormControlInput1">Nama Aset</label>
                                <input name="aset_name" type="text" class="form-control" id="nama_aset" placeholder="Nama Aset" value="{{$aset->aset_name}}">

                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="row6">
                        <div class="col">

                            <div class="form-group ">
                                <label for="berita_acara">Berita Acara</label>
                                <input type="text" class="form-control" disabled id="berita_acara" name="berita_acara" value="{{$aset->berita_acara}}">

                            </div>
                        </div>

                        <div class="col">

                            <label>File BA</label>
                            <br>
                            <label for="file_ba">
                            <a class="btn btn-warning">
                                <strong class="text-white">Upload</strong>
                            </a>
                            </label>
                            <input type="file" class="hidden" id="file_ba" name="file_ba" value="{{$aset->berita_acara}}">

                            <a class="btn btn-success">
                                <strong class="text-white">Download</strong>
                            </a>


                        </div>
                    </div>
                    <div class="row" id="row7">

                        <div class="col" id="foto_aset1_col">

                            <div class="form-group ">
                                <label for="foto_aset1">Foto Aset 1</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" height="120" id="foto_aset1">


                            </div>
                        </div>
                        <div class="col" id="foto_aset2_col">

                            <div class="form-group ">
                                <label for="foto_aset2">Foto Aset 2</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" height="120" id="foto_aset2">

                            </div>
                        </div>
                        <div class="col" id="foto_aset3_col">

                            <div class="form-group ">
                                <label for="foto_aset3">Foto Aset 3</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 3" width="150" height="120" id="foto_aset3">

                            </div>
                        </div>
                        <div class="col" id="foto_aset4_col">

                            <div class="form-group ">
                                <label for="foto_aset_4">Foto Aset 4</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" height="120" id="foto_aset4">
                            </div>
                        </div>

                        <div class="col" id="foto_aset5_col">

                            <div class="form-group ">
                                <label for="exampleFormControlInput1">Foto Aset 5</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 5" width="150" height="120" id="foto_aset5">

                            </div>
                        </div>
                    </div>
                    <div class="row mb-2" id="row9">
                        <div class="col" id="geo_tag1_col">
                            <a href="{{$aset->geo_tag1}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col" id="geo_tag2_col">
                            <a href="{{$aset->geo_tag2}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col" id="geo_tag3_col">
                            <a href="{{$aset->geo_tag3}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col" id="geo_tag4_col">
                            <a href="{{$aset->geo_tag4}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col" id="geo_tag5_col">
                            <a href="{{$aset->geo_tag5}}" class="btn btn-success w-100">MAP</a>
                        </div>
                    </div>

                    <div class="row mb-2" id="row10">
                        <div class="col" id="geo_tag1_non_tan_col">
                            <a href="{{$aset->geo_tag1}}" class="btn btn-success w-100">MAP</a>
                        </div>
                    </div>

                    <div class="row" id="row11">
                        <div class="col" >
                            <div class="form-group ">
                                <label for="persen_kondisi">Persen Kondisi</label>
                                <input type="text" class="form-control" id="persen_kondisi" name="persen_kondisi" value="{{$aset->persen_kondisi}}">

                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col" id="hgu_col">

                            <div class="form-group ">
                                <label for="hgu">HGU</label>
                                <input type="text" class="form-control" id="hgu" name="hgu" value="{{$aset->hgu}}">

                            </div>
                        </div>

                        <div class="col" id="aset_luas_tanaman_col">
                            <div class="form-group">
                                <label for="aset_luas">Luas Areal (Ha)</label>
                                <input class="form-control" id="aset_luas" name="aset_luas" value="{{$aset->aset_luas}}">
                            </div>
                        </div>
                        <div class="col" id="aset_luas_nontan_col">

                            <div class="form-group">
                                <label for="aset_luas">Kapasitas/Luas Bangunan</label>
                                <input class="form-control" id="aset_luas" name="aset_luas" value="{{$aset->aset_luas}}">
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="satuan_luas" name="satuan_luas">
                                    <option value="">Ha</option>
                                    <option>m2</option>
                                    <option>Item</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3" id="row12">
                        <div class="col" >

                            <div class="form-group ">
                                <label for="pop_total_ini">Populasi Total Saat Ini</label>
                                <input type="text" class="form-control" id="pop_total_ini" name="pop_pohon_saat_ini" value="{{$aset->pop_pohon_saat_ini}}">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_total_std">Populasi Total Standar</label>
                                <input type="text" class="form-control" id="pop_total_std" name="pop_standar" value="{{$aset->pop_standar}}">

                            </div>
                        </div>

                    </div>

                    <div class="row mt-3" id="row13">
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_hektar_ini">Populasi Hektar Saat Ini</label>
                                <input type="text" class="form-control" id="pop_hektar_ini" name="pop_per_ha" value="{{$aset->pop_per_ha}}" disabled>

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_hektar_std">Populasi Hektar Standar</label>
                                <input type="text" class="form-control" id="pop_hektar_std" name="presentase_pop_per_ha" disabled value="{{$aset->presentase_pop_per_ha}}">

                            </div>
                        </div>

                    </div>

                    <div class="row mt-3" id="row14">
                        <div class="col">

                            <div class="form-group ">
                                <label for="nilai_oleh">Nilai Perolehan</label>
                                <input type="text" class="form-control" id="nilai_oleh" name="nilai_oleh" value="{{$aset->nilai_oleh}}">

                            </div>
                        </div>

                        <div class="col">


                            <label for="tgl_oleh">Tanggal Perolehan</label>
                            <input type="datetime-local" class="form-control" id="tgl_oleh" name="tgl_oleh" value="{{$aset->tgl_oleh}}">

                        </div>
                    </div>
                    <div class="row mt-3"id="row15">
                        <div class="col">

                            <div class="form-group ">
                                <label for="nomor_bast">Nomor BAST</label>
                                <input type="text" class="form-control" id="nomor_bast" name="nomor_bast" value="{{$aset->nomor_bast}}">

                            </div>
                        </div>

                        <div class="col">

                            <label>File BAST</label>
                            <br>
                            <label for="file_bast">
                            <a class="btn btn-warning">
                                <strong class="text-white" id="upload_bast">Upload</strong>
                            </a>
                            </label>
                            <input type="file" class="hidden" id="file_bast" name="file_bast" value="{{$aset->file_bast}}">

                            <a class="btn btn-success">
                                <strong class="text-white" id="download_bast">Download</strong>
                            </a>


                        </div>
                    </div>
                    <div class="row mt-3" id="row16">
                        <div class="col">

                            <div class="form-group ">
                                <label for="masa_susut">Masa Penyusutan</label>
                                <input type="text" class="form-control" id="masa_susut" name="masa_susut" value="{{$aset->masa_susut}} Tahun">

                            </div>
                        </div>

                        <div class="col">


                            <label for="nilai_residu">Nilai Residu</label>
                            <input type="text" class="form-control" id="nilai_residu" name="nilai_residu" value="{{$aset->nilai_residu}}">

                        </div>

                    </div>
                    <div class="row" id="row17">

                        <div class="col">

                            <label for="keterangan">Keterangan</label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan">
                            {{$aset->keterangan}}
                            </textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-2">Simpan</button>

            </div>
            </form>

        </div>
    </div>
</div>
</div> <!-- end row -->


@endsection


@section('pluginJS')
<!-- third party js -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script>
    // kondisi awal checking

    if ($("#aset_tipe").val() == 1) {
            $("#row15").removeClass("hidden")
    } else {
        $("#row15").addClass("hidden")

    }

    if ($("#aset_kode_nontan").val() == 8) {
            $("#alat_angkut_row").removeClass("hidden")
    } else {
        $("#alat_angkut_row").addClass("hidden")

    }

    if ($("#aset_jenis").val() == 1) {
            $("#aset_kode_tanaman").removeClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#aset_kode_kayu").addClass("hidden")

            // sistem tanam
            $("#sistem_tanam_row").removeClass("hidden")
            $("#row7").removeClass("hidden")
            $("#foto_aset5_col").removeClass("hidden")
            $("#aset_luas_nontan_col").removeClass("hidden")

            $("#row8").addClass("hidden")
            $("#aset_luas_tanaman_col").addClass("hidden")
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
    } else if ($("#aset_jenis").val() == 2){
        $("#aset_kode_tanaman").addClass("hidden")
        $("#aset_kode_nontan").removeClass("hidden")
        $("#aset_kode_kayu").addClass("hidden")

         // sistem tanam
        $("#sistem_tanam_row").addClass("hidden")
        $("#foto_aset5_col").addClass("hidden")
        $("#aset_luas_nontan_col").addClass("hidden")
        $("#row9").addClass("hidden")

        $("#aset_luas_tanaman_col").removeClass("hidden")
        $("#row12").addClass("hidden")
        $("#row13").addClass("hidden")
    } else {
        $("#aset_kode_tanaman").addClass("hidden")
        $("#aset_kode_kayu").removeClass("hidden")
        $("#aset_kode_nontan").addClass("hidden")

         // sistem tanam
        $("#sistem_tanam_row").removeClass("hidden")
        $("#row7").removeClass("hidden")
        $("#foto_aset5_col").removeClass("hidden")
        $("#aset_luas_nontan_col").removeClass("hidden")

        $("#row8").addClass("hidden")
        $("#aset_luas_tanaman_col").addClass("hidden")
        $("#row12").addClass("hidden")
        $("#row13").addClass("hidden")
    }

    if ($("#aset_kondisi").val() == 1) {
        $("#row6").addClass("hidden")
    } else {
        $("#row6").removeClass("hidden")

    }

    $("#aset_tipe").change(function (e) {
        if (e.target.value == 1) {
            $("#row15").removeClass("hidden")
        } else {

            $("#row15").addClass("hidden")
        }
    })

    $("#aset_jenis").change(function (e) {
        if (e.target.value == 1) {
            // aset kode
            $("#aset_kode_tanaman").removeClass("hidden")
            $("#aset_kode_kayu").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")


            // sistem tanam
            $("#sistem_tanam_row").removeClass("hidden")
            $("#row7").removeClass("hidden")
            $("#row9").removeClass("hidden")
            $("#foto_aset5_col").removeClass("hidden")
            $("#aset_luas_nontan_col").removeClass("hidden")
            $("#row12").removeClass("hidden")
            $("#row13").removeClass("hidden")

            $("#row10").addClass("hidden")
            $("#row11").addClass("hidden")
            $("#aset_luas_nontan_col").addClass("hidden")


        } else if (e.target.value == 2){
             $("#aset_kode_tanaman").addClass("hidden")
            $("#aset_kode_nontan").removeClass("hidden")
            $("#aset_kode_kayu").addClass("hidden")

            // sistem tanam
            $("#sistem_tanam_row").addClass("hidden")
            $("#foto_aset5_col").addClass("hidden")
            $("#aset_luas_nontan_col").addClass("hidden")
            $("#row9").addClass("hidden")

            $("#aset_luas_tanaman_col").removeClass("hidden")
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
        } else {
            $("#aset_kode_tanaman").addClass("hidden")
            $("#aset_kode_kayu").removeClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")


            // sistem tanam
            $("#sistem_tanam_row").removeClass("hidden")
            $("#row7").removeClass("hidden")
            $("#row9").removeClass("hidden")
            $("#foto_aset5_col").removeClass("hidden")
            $("#aset_luas_nontan_col").removeClass("hidden")
            $("#row12").removeClass("hidden")
            $("#row13").removeClass("hidden")

            $("#row10").addClass("hidden")
            $("#aset_luas_nontan_col").addClass("hidden")
        }
    })
    $("#aset_kondisi").change(function (e) {
        if (e.target.value == 1) {
            $("#row6").addClass("hidden")

        } else {
            $("#row6").removeClass("hidden")

        }
    })

    $("#aset_kode_nontan").change(function (e) {
        if (e.target.value == 8) {
            $("#alat_angkut_row").removeClass("hidden")
        } else {
            $("#alat_angkut_row").addClass("hidden")
        }
    })

    $("#aset_kode_tanaman").change(function (e) {
        if (e.target.value == 22) {
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
            $("#sistem_tanam_col").addClass("hidden")
        } else {
            $("#row12").removeClass("hidden")
            $("#row13").removeClass("hidden")
            $("#sistem_tanam_col").removeClass("hidden")

        }
    })


    // sistem tanam

    // tebu
    console.log($("#aset_kode_tanaman").val());


    $("#sistem_tanam").change(function (e) {
        if(e.target.value == 1){
            if ($("#aset_kode").val() != 22) {
                $("#row12").removeClass("hidden")
                $("#row13").removeClass("hidden")
            } else {
                $("#row12").addClass("hidden")
                $("#row13").addClass("hidden")
            }
        }

        else if (e.target.value == 2) {
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
        } else {
            $("#row12").addClass("hidden")
            $("#row13").addClass("hidden")
        }
    })

    $("#sistem_tanam").change(function (e) {

    })

    // bast

</script>
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Buttons js -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

<!-- Responsive js -->
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatables init -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection

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
        display: none;
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Data {{ $title }}</h4><br>

                <form action="{{url('aset/'.$aset->aset_id)}}" method="post" enctype="multipart/form-data">


                    <div class="row">
                        <div class="col">

                            <div class="form-group ">
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
                    <div class="row">



                        <div class="col">

                            <div class="form-group ">
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
                                <label for="aset_kode">Kode Aset</label>
                                <select class="form-control" id="aset_kode" name="aset_kode">
                                    @foreach($all_kode as $aset_kode)
                                    <?php
                                    $aset_kode_temp = "";
                                    if ($aset_kode->aset_jenis == 1) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_desc;
                                    } else if ($aset_kode->aset_jenis == 2) {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    } else {
                                        $aset_kode_temp = $aset_kode->aset_class . "/" . $aset_kode->aset_group . "/" . $aset_kode->aset_desc;
                                    }

                                    $aset->aset_kode = $aset_kode_temp;

                                    ?>

                                    @if($aset->aset_jenis == $aset_kode->aset_jenis)
                                    @if( $aset->aset_kode == $aset_kode->aset_kode_id )
                                    <option value="{{$aset_kode->aset_kode_id}}" selected>

                                        {{$aset_kode_temp}}
                                    </option>
                                    @else
                                    <option value="{{$aset_kode->aset_kode_id}}">{{$aset_kode_temp}}</option>
                                    @endif
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">



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
                    <div class="row">

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
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="exampleFormControlInput1">Nama Aset</label>
                                <input name="aset_name" type="text" class="form-control" id="nama_aset" placeholder="Nama Aset" value="{{$aset->aset_name}}">

                            </div>
                        </div>
                    </div>
                    @if(isset($aset->berita_acara))
                    <div class="row mt-3">
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
                    @endif
                    <div class="row">



                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset1">Foto Aset 1</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" height="120" id="foto_aset1">


                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset2">Foto Aset 2</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" height="120" id="foto_aset2">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset3">Foto Aset 3</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 3" width="150" height="120" id="foto_aset3">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset_4">Foto Aset 4</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" height="120" id="foto_aset4">
                            </div>
                        </div>

                        @if($aset->aset_jenis == 1)
                        <div class="col">

                            <div class="form-group ">
                                <label for="exampleFormControlInput1">Foto Aset 5</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 5" width="150" height="120" id="foto_aset5">

                            </div>
                        </div>
                        @endif
                    </div>
                    @if($aset->aset_jenis == 1)
                    <div class="row mb-2">
                        <div class="col">
                            <a href="{{$aset->geo_tag1}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="{{$aset->geo_tag2}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="{{$aset->geo_tag3}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="{{$aset->geo_tag4}}" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="{{$aset->geo_tag5}}" class="btn btn-success w-100">MAP</a>
                        </div>
                    </div>

                    @else
                    <div class="row mb-2">
                        <div class="col">
                            <a href="{{$aset->geo_tag1}}" class="btn btn-success w-100">MAP</a>
                        </div>
                    </div>

                    @endif
                    @if($aset->aset_jenis==2)
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="persen_kondisi">Persen Kondisi</label>
                                <input type="text" class="form-control" id="persen_kondisi" name="persen_kondisi" value="{{$aset->persen_kondisi}}">

                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row ">
                        <div class="col">

                            <div class="form-group ">
                                <label for="hgu">HGU</label>
                                <input type="text" class="form-control" id="hgu" name="hgu" value="{{$aset->hgu}}">

                            </div>
                        </div>

                        @if($aset->aset_jenis==1)
                        <div class="col">
                            <div class="form-group">
                                <label for="aset_luas">Luas Areal (Ha)</label>
                                <input class="form-control" id="aset_luas" name="aset_luas" value="{{$aset->aset_luas}}">
                            </div>
                        </div>
                        @else
                        <div class="col">

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

                        @endif
                    </div>

                    @if($aset->aset_jenis == 1)
                    <div class="row mt-3">
                        <div class="col">

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

                    <div class="row mt-3">
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
                    @endif

                    <div class="row mt-3">
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
                    <div class="row mt-3">
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
                                <strong class="text-white">Upload</strong>
                            </a>
                            </label>
                            <input type="file" class="hidden" id="file_bast" name="file_bast" value="{{$aset->file_bast}}">

                            <a class="btn btn-success">
                                <strong class="text-white">Download</strong>
                            </a>


                        </div>
                    </div>
                    <div class="row mt-3">
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
                    <div class="row">

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
<script>
    function readURL(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#foto_aset' + i).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
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

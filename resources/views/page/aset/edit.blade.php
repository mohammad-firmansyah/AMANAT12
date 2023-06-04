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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<style>
    .hidden {
        display: none !important;
    }



    .selected-card{
        border:2px solid #02c0ce !important;
        background:#ccebed !important;
    }


    #search-sap{
        max-height:400px;
        overflow: auto;
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
                                <input name="tahun_tanam"  type="text" class="form-control" id="tahun_tanam" placeholder="tahun tanam" value="{{$aset->tahun_tanam}}">
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
                                <input name="nomor_sap" type="text" class="form-control" id="nomor_sap" placeholder="Nomor SAP" value="{{$aset->nomor_sap}}" disabled>
                            </div>
                        </div>

                        <div class="col">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">
                                Pilih Nomor SAP
                            </button>
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
                                <label for="aset_luas_tanaman">Luas Areal (Ha)</label>
                                <input class="form-control" id="aset_luas_tanaman" name="aset_luas" value="{{$aset->aset_luas}}">
                            </div>
                        </div>
                        <div class="col" id="aset_luas_nontan_col">

                            <div class="form-group">
                                <label for="aset_luas_nontan">Kapasitas/Luas Bangunan</label>
                                <input class="form-control" id="aset_luas_nontan" name="aset_luas" value="{{$aset->aset_luas}}">
                            </div>


                        </div>

                        <div class="col" id="satuan-luas">
                            <div class="form-group">
                                <label for="aset_luas">Satuan Luas</label>
                                <select class="form-control" id="satuan_luas" name="satuan_luas">
                                    <option value="ha" selected>Ha</option>
                                    <option value="m2">m2</option>
                                    <option value="item">Item</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3" id="row12">
                        <div class="col" >

                            <div class="form-group ">
                                <label for="pop_pohon_saat_ini">Populasi Pohon Saat Ini</label>
                                <input type="text" class="form-control" id="pop_pohon_saat_ini" name="pop_pohon_saat_ini" value="{{$aset->pop_pohon_saat_ini}}">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_std">Populasi Standar</label>
                                <input type="text" class="form-control" id="pop_std" name="pop_std" value="{{$aset->pop_standar}}">

                            </div>
                        </div>

                    </div>

                    <div class="row mt-3" id="row13">
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_per_ha">Populasi per Hektar</label>
                                <input type="text" class="form-control" id="pop_per_ha" name="pop_per_ha" value="{{$aset->pop_per_ha}}" disabled>

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="presentase_pop_per_ha">Presentase Populasi Per HA</label>
                                <input type="text" class="form-control" id="presentase_pop_per_ha" name="presentase_pop_per_ha" disabled value="{{$aset->presentase_pop_per_ha}}">

                            </div>
                        </div>

                    </div>

                    <div class="row mt-3" id="row14">
                        <div class="col">

                            <div class="form-group ">
                                <label for="nilai_oleh">Nilai Perolehan</label>
                                <input type="text" disabled class="form-control" id="nilai_oleh" name="nilai_oleh" value="{{$aset->nilai_oleh}}">

                            </div>
                        </div>

                        <div class="col">


                            <label for="tgl_oleh">Tanggal Perolehan</label>
                            <input type="datetime-local" disabled class="form-control" id="tgl_oleh" name="tgl_oleh" value="{{$aset->tgl_oleh}}">

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
                            <a class="btn btn-warning" id="file_bast_btn">
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
                                <input type="text" disabled class="form-control" id="masa_susut" name="masa_susut" value="{{$aset->masa_susut}} Tahun">

                            </div>
                        </div>

                        <div class="col">


                            <label for="nilai_residu">Nilai Residu</label>
                            <input type="text" class="form-control" disabled id="nilai_residu" name="nilai_residu" value="{{$aset->nilai_residu}}">

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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Nomor SAP</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" placeholder="cari nomor sap" id="input-sap">
        <div id="search-sap">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit-sap" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('pluginJS')
<!-- third party js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{asset('assets/js/edit-visibility-dynamic.js')}}"></script>
<script src="{{asset('assets/js/populasi.js')}}"></script>
<script>

let data;

fetch("http://localhost:8000/api/sap",{
    method:'GET',
    headers:{
        'Accept':'application/json',
    },
})
.then(response => response.json())
.then((response) => {
    // myImage.src = URL.createObjectURL(response);
    data = response
    console.log(data);

});



$("#input-sap").keypress(function (e) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        $('#search-sap').html('')
    const result = data.filter(function (e) {
        if (e.unit_id == {{$unit_id}}) {
            return e
        }
    })

    for (let index = 0; index < result.length; index++) {
        if (result[index].sap_desc.includes(e.target.value)){
            const card ="<div class=\'p-2 mt-2 border d-flex justify-content-between align-items-center\'><span class=\'font-weight-bold\'>"+result[index].sap_desc+"</span><button data='"+result[index].sap_desc+"' class=\'btn btn-primary select-sap\' id='sap-"+(index+1)+"' onclick='selectSAP(this.id)'>Pilih</button></div>"
            $('#search-sap').append(card)
        }
    }

}
})

let sap;
function selectSAP(e) {
    $("#"+e).parent().removeClass("border")

    let selectedCards = document.querySelectorAll(".selected-card")
    selectedCards.forEach(selectedCard => {
        selectedCard.classList.remove("selected-card")
    });

    $("#"+e).parent().addClass("selected-card")


    sap = $("#"+e).attr("data")
    console.log($("#"+e).attr("data"));

}


$("#submit-sap").click(function (e) {
    $("#nomor_sap").val(sap)
})



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

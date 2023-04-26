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
                <h4 class="header-title">Buat {{ $title }}</h4><br>
            <form action="{{url('aset/laporan')}}" method="post">
                @csrf
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label for="aset_tipe">Tipe Aset</label>
                            <select class="form-control" id="aset_tipe" name="aset_tipe">
                                @foreach($all_tipe as $aset_tipe)
                                <option value="{{$aset_tipe->aset_tipe_id}}">{{$aset_tipe->aset_tipe_desc}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="aset_jenis">Jenis Aset</label>
                            <select class="form-control" id="aset_jenis" name="aset_jenis">
                                @foreach($all_jenis as $aset_jenis)
                                <option value="{{$aset_jenis->aset_jenis_id}}">{{$aset_jenis->aset_jenis_desc}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="aset_kondisi">Kondisi Aset</label>
                            <select class="form-control" id="aset_kondisi" name="aset_kondisi">
                                @foreach($all_kondisi as $aset_kondisi)
                                <option value="{{$aset_kondisi->aset_kondisi_id}}">{{$aset_kondisi->aset_kondisi_desc}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
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

                                    <option value="{{$aset_kode->aset_kode_id}}">{{$aset_kode_temp}}</option>
                                    @endforeach
                                </select>
                                <select class="form-control hidden" id="aset_kode_nontan" name="aset_kode">
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

                                    <option value="{{$aset_kode->aset_kode_id}}">{{$aset_kode_temp}}</option>
                                    @endforeach
                                </select>
                                <select class="form-control hidden" id="aset_kode_kayu" name="aset_kode">
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

                                    <option value="{{$aset_kode->aset_kode_id}}">{{$aset_kode_temp}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                         <div class="form-group">
                                <label for="tgl_input1">Tanggal Input Mulai</label>
                                <input name="tgl_input1" required  type="date" class="form-control" id="tgl_input1" placeholder="Tanggal input">


                            </div>
                    </div>
                    <div class="col">
                        <div class="form-group">

                            <label for="tgl_input2">Tanggal Input Berahkir</label>
                            <input name="tgl_input2" required type="date" class="form-control" id="tgl_input2" placeholder="Tanggal input">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">

                        <div class="form-group">
                            <label for="jenis_report">Jenis Report</label>
                            <select class="form-control" id="jenis_report" name="jenis_report">
                                <option value="excel">Excel</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        </div>
                </div>

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Jenis Report</label>
                            <br>
                            <input type="radio" name="qrcode" id="qrcode" required value="1">
                            <label for="qrcode" class="mr-2">qrcode</label>
                            <input type="radio" name="qrcode" id="qrcodeplusfoto" required value="2">
                            <label for="qrcodeplusfoto" class="mr-2">qrcode+Foto</label>
                            <input type="radio" required name="qrcode" id="tanpaqrcode" value="3">
                            <label for="tanpaqrcode">tanpa qrcode</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-100 btn btn-primary">UNDUH REPORT</button>
                </form>
        </div>
    </div>
</div>
</div> <!-- end row -->


@endsection


@section('pluginJS')
<!-- third party js -->
<script>

    $("#aset_jenis").change(function (e) {
        if (e.target.value == 1) {
            $("#aset_kode_tanaman").removeClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#aset_kode_kayu").addClass("hidden")
        } else if(e.target.value == 2) {
            $("#aset_kode_tanaman").addClass("hidden")
            $("#aset_kode_kayu").addClass("hidden")
            $("#aset_kode_nontan").removeClass("hidden")
        } else {
            $("#aset_kode_tanaman").addClass("hidden")
            $("#aset_kode_nontan").addClass("hidden")
            $("#aset_kode_kayu").removeClass("hidden")
        }
    })

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
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

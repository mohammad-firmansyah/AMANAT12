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

                <form action="{{url('aset/'.$aset->aset_id)}}" method="post">


                    <div class="row">
                        <div class="col">

                            <div class="form-group ">
                                <label for="aset_tipe">Tipe Aset</label>
                                <select class="form-control" id="aset_tipe" name="aset_tipe">
                                    <option>1</option>
                                </select>

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="aset_jenis">Aset Jenis</label>
                                <select class="form-control" id="aset_jenis" name="aset_jenis">
                                    <option>tanaman</option>
                                    <option>non tanaman</option>
                                    <option>kayu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">



                        <div class="col">

                            <div class="form-group ">
                                <label for="aset_kondisi">Kondisi Aset</label>
                                <select class="form-control" id="aset_kondisi" name="aset_kondisi">
                                    <option>1</option>
                                </select>

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="aset_kode">Kode Aset</label>
                                <select class="form-control" id="aset_kode" name="aset_kode">
                                    <option>1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">



                        <div class="col">

                            <div class="form-group ">
                                <label for="unit">Unit</label>
                                <select class="form-control" id="unit" name="unit" disabled>
                                    <option>1</option>
                                </select>

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="sub_unit">Sub Unit</label>
                                <select class="form-control" id="sub_unit" name="sub_unit" disabled>
                                    <option>1</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group ">
                                <label for="afdeling">Afdeling</label>
                                <select class="form-control" id="afdeling" name="afdeling" disabled>
                                    <option>1</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">





                        <div class="col">

                            <div class="form-group">

                                <label for="nomor_sap">Nomor SAP</label>
                                <select class="form-control" id="nomor_sap" name="nomor_sap">
                                    <option>1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col">

                            <div class="form-group ">
                                <label for="exampleFormControlInput1">Nama Aset</label>
                                <input name="aset_name" type="text" class="form-control" id="nama_aset" placeholder="Nama Aset">

                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset1">Foto Aset 1</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" id="foto_aset1">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset2">Foto Aset 2</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 2" width="150" id="foto_aset2">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset33">Foto Aset 3</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 3" width="150" id="foto_aset_3">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="foto_aset_4">Foto Aset 4</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 4" width="150" id="foto_aset_4">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="exampleFormControlInput1">Foto Aset 5</label><br>
                                <img src="{{asset('assets/images/default-img.png')}}" alt="default img 1" width="150" id="foto_aset_5">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-success w-100">MAP</a>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-success w-100">MAP</a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <a href="#" class="btn btn-success w-100">MAP</a>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">

                            <div class="form-group ">
                                <label for="hgu">HGU</label>
                                <input type="text" class="form-control" id="hgu" name="hgu">

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="aset_luas">Luas Areal (Ha)</label>
                                <input class="form-control" id="aset_luas" name="aset_luas">
                            </div>

                        </div>

                        <div class="col">

                            <div class="form-group">
                                <label for="aset_luas">Kapasitas/Luas Bangunan</label>
                                <input class="form-control" id="aset_luas" name="aset_luas">
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="satuan_luas" name="satuan_luas">
                                    <option>Ha</option>
                                    <option>m2</option>
                                    <option>Item</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    
                    <div class="row mt-3">
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_total_ini">Populasi Total Saat Ini</label>
                                <input type="text" class="form-control" id="pop_total_ini" name="pop_total_ini">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_total_std">Populasi Total Standar</label>
                                <input type="text" class="form-control" id="pop_total_std" name="pop_total_std">

                            </div>
                        </div>

                    </div>
                   
                    <div class="row mt-3">
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_hektar_ini">Populasi Hektar Saat Ini</label>
                                <input type="text" class="form-control" id="pop_hektar_ini" name="pop_hektar_ini">

                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="pop_hektar_std">Populasi Hektar Standar</label>
                                <input type="text" class="form-control" id="pop_hektar_std" name="pop_hektar_std">

                            </div>
                        </div>

                    </div>
                   
                    <div class="row mt-3">
                        <div class="col">

                            <div class="form-group ">
                                <label for="nilai_oleh">Nilai Perolehan</label>
                                <input type="text" class="form-control" id="nilai_oleh" name="nilai_oleh">

                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group ">
                                <label for="tgl_oleh">Tanngal Perolehan</label>
                                <input type="text" class="form-control" id="tgl_oleh" name="tgl_oleh">

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div> <!-- end row -->


<div id="modal_ubah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_ubah" method="post" action="{!! url('master/komoditas/update') !!}">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Ubah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="ubah_id" name="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ubah_nama" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="ubah_nama" name="nama" placeholder="Nama Komoditas" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="ubah_keterangan" class="control-label">Keterangan</label>
                                <textarea class="form-control" id="ubah_keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

@endsection

@section('pluginJS')
<!-- third party js -->
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
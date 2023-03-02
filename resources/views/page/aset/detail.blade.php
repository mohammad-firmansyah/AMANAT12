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
                {{-- <p class="sub-header"></p> --}}

                <table id="responsive-datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <tbody>


                        <tr style="text-align: center;">
                            <td><strong>ASET TIPE</strong></td>
                            <td>{{$aset->aset_tipe}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>ASET JENIS</strong></td>
                            <td>{{$aset->aset_jenis}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>ASET KONDISI</strong></td>
                            <td>{{$aset->aset_kondisi}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>ASET KODE</strong></td>
                            <td>{{$aset->aset_kode}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>SUB UNIT</strong></td>
                            <td>{{$aset->aset_sub_unit}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>UNIT</strong></td>
                            <td>{{$aset->unit_id}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>AFDELING</strong></td>
                            <td>{{$aset->afdeling_id}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>NAMA ASET</strong></td>
                            <td>{{$aset->aset_name}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong> NOMOR SAP :</strong></td>
                            <td>{{$aset->nomor_sap}}</td>
                        </tr>

                        <tr style="text-align: center;">
                            <td>Foto Aset</td>
                            <td>
                                <img src="{{asset($aset->foto_aset1)}}" alt="foto aset 1">
                                <img src="{{asset($aset->foto_aset2)}}" alt="foto aset 2">
                                <img src="{{asset($aset->foto_aset3)}}" alt="foto aset 3">
                                <img src="{{asset($aset->foto_aset4)}}" alt="foto aset 4">
                            </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td>Map</td>
                            <td>
                                @if($aset->aset_jenis == 'tanaman')
                                <a href="{{$aset->geo_tag1}}" class="btn btn-success">Map</a>
                                <a href="{{$aset->geo_tag2}}" class="btn btn-success">Map</a>
                                <a href="{{$aset->geo_tag3}}" class="btn btn-success">Map</a>
                                <a href="{{$aset->geo_tag4}}" class="btn btn-success">Map</a>
                                <a href="{{$aset->geo_tag5}}" class="btn btn-success">Map</a>
                                @else
                                <a href="{{$aset->geo_tag5}}" class="btn btn-success">Map</a>
                                @endif
                            </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>HGU</strong></td>
                            <td>{{$aset->hgu}}</td>
                        </tr>
                        @if($aset->aset_jenis == 'non tanaman')
                        <tr style="text-align: center;">
                            <td><strong>PERSEN KONDISI</strong></td>
                            <td>{{$aset->persen_kondisi}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>KAPASITAS / LUAS BANGUNAN</strong></td>
                            <td>{{$aset->aset_luas}}</td>
                            <td>{{$aset->satuan_luas}}</td>
                        </tr>
                        @else
                        <tr style="text-align: center;">
                            <td><strong>LUAS LAHAN /HA</strong></td>
                            <td>{{$aset->aset_luas}}</td>
                        </tr>

                        @endif
                        <tr style="text-align: center;">
                            <td><strong>NILAI PEROLEHAN</strong></td>
                            <td>{{$aset->nilai_oleh}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>TANGGAL PEROLEHAN</strong></td>
                            <td>{{$aset->tgl_oleh}}</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>MASA PENYUSUTAN</strong></td>
                            <td>{{$aset->masa_susut}} Tahun</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>NOMOR BAST</strong></td>
                            <td>{{$aset->nomor_bast}} </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>NILAI RESIDU</strong></td>
                            <td>{{$aset->nilai_residu}} </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>UMUR EKONOMIS</strong></td>
                            <td>{{$aset->umur_ekonomis}} </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><strong>KETERANGAN</strong></td>
                            <td>{{$aset->keterangan}} </td>
                        </tr>
                        </tr>
                    </tbody>

                </table>
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
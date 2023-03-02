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
    <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
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
                    <thead>
                        <tr style="text-align: center;">
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Nilai Aset</th>
                            <th>Nomor SAP</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Masa Susut</th>
                            <th>Jenis Aset</th>
                            <th>Afdeling</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($aset as $key => $value)
                        <tr style="text-align: center;">
                            <td>{{$key + 1}}</td>
                            <td>{{$value->tgl_oleh}}</td>
                            <td>{{$value->aset_name}}</td>
                            <td>{{$value->nilai_oleh}}</td>
                            <td>{{$value->nomor_sap}}</td>
                            <td>
                                <a href="{{url('aset/'.$value->aset_id)}}" class="btn btn-success ">Detail</a>
                                @if(($value->status_posisi_id % 2) != 0 && Str::lower($value->status_posisi) == Str::lower($jabatan))
                                <a href="#" class="btn btn-warning mx-2">Edit</a>
                                @endif
                                @if($jabatan == "Operator" && $value->status_posisi_id == 1 )
                                <a href="#" class="btn btn-danger ">Delete</a>@endif
                            </td>
                            <td>{{$value->status_posisi}}</td>
                            <td>{{$value->masa_susut}} Tahun</td>
                            <td>{{$value->aset_jenis}}</td>
                            <td>{{$value->afdeling_id}}</td>
                        </tr>
                        @endforeach
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
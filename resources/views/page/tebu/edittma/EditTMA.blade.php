
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- third party css end -->
@endsection

@section('breadcump')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
        <li class="breadcrumb-item active"></li>
    </ol>
@endsection

@section('content')
<style>
        .info{
            display: none;
        }
        .icon:hover ~ .info{
            display: block;
        }
    </style>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Data </h4><br>
                        <p class="sub-header"></p>
                    
                    <div class="grupExport mb-3">
                        <span class="card-text">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_export_excel" data-backdrop="static"><i class="fa fa-plus mr-1"></i> Export Excel</button>
                        </span>
                        
                        <span class="card-text ml-1">
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#modal_export_pdf" data-backdrop="static"><i class="fa fa-plus mr-1"></i> Export PDF</button>
                        </span>
                    </div>

                    <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Nopol</th>
                                <th>Afdeling</th>
                                <th>Timbang / Kebun</th>
                                <th>Status Tanam</th>
                                <th>Petak Tebang</th>
                                <th>Tebang Muat</th>
                                <th>Foto Truk</th>
                                <th>No SPTA</th>
                                <th>Foto SPTA</th>
                                <th>Hasil Timbang</th>
                                <th>Nota Timbang</th>
                                <th>Foto Timbang</th>
                                <th>PG Tujuan</th>
                                <th>H.Grab Vendor</th>
                                <th>H.Grab Mandiri</th>
                                <th>H.Manual</th>
                                <th>Berita Acara</th>
                                <th>Sumber Dana</th>
                                <th>Tarif Penyesuaian</th>
                                <th>Ket Revisi</th>
                                <th>posisi data</th>
                                <th>Action</th>
                            </tr>               
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end row 1233-->

    <!-- sorting data export excel -->
    <div id="modal_export_excel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_export" method="post" action="{{ route('exportExcel') }}" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Export Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                     <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pilih_posisi" class="control-label">Posisi</label>
                                    <select class="form-control select2" id="pilih_posisi" name="posisi_id[]" multiple>
                                        <option disabled> -- Pilih Posisi -- </option>
                                        @foreach ($posisi as $key => $value)
                                            <option value="{{ $value->posisi_id}}" > {{ $value->ket_posisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_afdeling" class="control-label">Afdeling</label>
                                <select class="form-control select2" id="pilih_afdeling" name="afdel_id[]" multiple>
                                    <option disabled> -- Pilih Afdeling -- </option>
                                    @foreach ($data_afdel as $key => $value)
                                        <option value="{{ $value->afdel_id}}" > {{ $value->nama_afdeling }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($jabatan == "ADMIN KEBUN")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun" name="kebun_id[]" >
                                    <option value="" selected disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}" selected > {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($jabatan != "ADMIN KEBUN")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun" name="kebun_id[]" multiple>
                                    <option disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}" > {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_status" class="control-label">Status</label>
                                <select class="form-control select2" id="pilih_status" name="status_tanam[]" multiple>
                                    <option disabled> -- Pilih Status -- </option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $value}}" > {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <p style="font-size:10px">Klik Kolom Untuk Menghapus Value</p>
                                <label for="filter_date" class="control-label">Filter By Date</label>
                               <p><input type="text" id="from_datepicker" name="start_date"  onfocus="this.value=''" placeholder="first date"> to <input type="text" id="to_datepicker"  onfocus="this.value=''" name="end_date" placeholder="last date" ></p>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- end row -->
    <!-- sorting data export pdf -->
    <div id="modal_export_pdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_export_pdf" method="post" action="{{ route('exportPDF') }}" target="_blank">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Export Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pilih_posisi_p" class="control-label">Posisi</label>
                                    <select class="form-control select2" id="pilih_posisi_p" name="posisi_id[]" multiple>
                                        <option disabled> -- Pilih Posisi -- </option>
                                        @foreach ($posisi as $key => $value)
                                            <option value="{{ $value->posisi_id}}" > {{ $value->ket_posisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_afdeling_p" class="control-label">Afdeling</label>
                                <select class="form-control select2" id="pilih_afdeling_p" name="afdel_id[]" multiple>
                                    <option disabled> -- Pilih Afdeling -- </option>
                                    @foreach ($data_afdel as $key => $value)
                                        <option value="{{ $value->afdel_id}}" > {{ $value->nama_afdeling }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($jabatan == "ADMIN KEBUN")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun_p" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun_p" name="kebun_id[]" >
                                    <option value="" selected disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}" selected> {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($jabatan != "ADMIN KEBUN")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun_p" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun_p" name="kebun_id[]" multiple >
                                    <option disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}"> {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_status_p" class="control-label">Status</label>
                                <select class="form-control select2" id="pilih_status_p" name="status_tanam[]" multiple >
                                    <option disabled> -- Pilih Status -- </option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $value}}" > {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="filter_date" class="control-label">Filter By Date</label>
                                <p style="font-size:10px">Klik Kolom Untuk Menghapus Value</p>
                               <p><input type="text" id="from_datepicker_p"  onfocus="this.value=''" name="start_date" placeholder="first date"> to <input type="text" id="to_datepicker_p" onfocus="this.value=''" name="end_date" placeholder="last date" ></p>

                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light third">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- edit label -->
    <div id="modal_ubah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_ubah" method="post" action="{!! url('edit/datatebu/update') !!}" >
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" id="ubah_id" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_nopol" class="control-label">Nopol</label>
                                    <input type="text" class="form-control" id="ubah_nopol" name="nopol" placeholder="Nopol" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_spta" class="control-label">No SPTA</label>
                                    <input type="text" class="form-control" id="ubah_spta" name="nomor_spta" placeholder="SPTA" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_statanam" class="control-label">Status Tanam</label>
                                    <select class="form-control select2" id="ubah_statanam" name="statustanam_id" >
                                        <option disabled> -- Pilih Status -- </option>
                                        @foreach ($status as $key => $value)
                                            <option value="{{ $value}}" > {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_petak" class="control-label">Petak Kebun</label>
                                    <select class="form-control select2" id="ubah_petak" name="petak_id" >
                                        <option value="" selected disabled> -- Pilih Petak -- </option>
                                        @foreach ($petaktebang as $key => $value)
                                            <option value="{{ $value->petak_tebu_id}}"> {{ $value->petak_tanam }} - {{$value->zonasi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_posisi" class="control-label">Posisi Data</label>
                                    <select class="form-control select2" id="ubah_posisi" name="posisi_id" >
                                        <option value="" selected disabled> -- Pilih Posisi -- </option>
                                        @foreach ($posisi as $key => $value)
                                            <option value="{{ $value->posisi_id}}" > {{ $value->ket_posisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_sumberdana" class="control-label">Sumber Dana</label>
                                    <input type="text" class="form-control" id="ubah_sumberdana" name="sumber_dana" placeholder="Sumber DANA" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_hasiltimbang" class="control-label">Hasil Timbang</label>
                                    <input type="text" class="form-control" id="ubah_hasiltimbang" name="hasil_timbang" placeholder="Hasil Timbang" >
                                </div>
                            </div>
                        </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



   

    

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

    <!-- datepicker -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

@endsection

@section('customJS')
    <script type="text/javascript">


        var tabel;

        $(document).ready(function() {

            $('#pilih_posisi').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_afdeling').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_kebun').select2({dropdownParent: $("#modal_export_excel")}); 
            $('#pilih_status').select2({dropdownParent: $("#modal_export_excel")}); 
            $('#pilih_posisi_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_afdeling_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_kebun_p').select2({dropdownParent: $("#modal_export_pdf")}); 
            // $('#ubah_statanam').select2({dropdownParent: $("#modal_ubah")});
            $('#ubah_petak').select2({dropdownParent: $("#modal_ubah")});
            // $('#ubah_posisi').select2({dropdownParent: $("#modal_ubah")});
            
            
            tabel = $('#table').DataTable({
                processing: false,
                serverSide: true,
                // ajax: '{{ url('tebu/datatebu/get', [$data1['unit_id']]) }}',
                // ajax: '{{ url('tebu/datatebu/get') }}',
                ajax : {
                    'url' : '{{ url('edit/datatebu/get') }}',
                    'type' : 'post',
                    'data' : {_token: "{{csrf_token()}}"}
                },
                order: [],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user_nama', name : 'user.user_nama'},
                    { data: 'nopol', name : 'nopol'},
                    { data: 'kebun_afdeling', name : 'kebun_afdeling'},
                    { data: 'nama_truk', name: 'master_timbangkebun.nama_truk' },
                    { data: 'statustanam_id', name: 'statustanam_id' },
                    { data: 'petak_tanam', name: 'master_petaktebang_tebu.petak_tanam' },
                    { data: 'tebang_muat', name: 'master_tebangmuat.tebang_muat' },
                    { data: 'foto_edit', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fototruk(${row.tma_id})">foto truk</button>`;
                        },
                        searchable: false
                    },
                    { data: 'nomor_spta', name: 'nomor_spta' },
                    { data: 'foto_spta_edit', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fotospta('${row.tma_id}')">foto SPTA</button>`;
                        },
                        searchable: false
                    },
                    { data: 'hasil_timbang', name: 'hasil_timbang' },
                    { data: 'nota_timbang', name: 'nota_timbang' },
                    { data: 'foto_timbang_edit', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fototimbang('${row.tma_id}')">foto Nota Timbang</button>`;
                        },
                        searchable: false
                    },
                    { data: 'pg_tujuan', name: 'pg_tujuan' },
                    { data: 'hrg_grab_vendor', name: 'hrg_grab_vendor' },
                    { data: 'hrg_grab_mandiri', name: 'hrg_grab_mandiri' },
                    { data: 'hrg_manual', name: 'hrg_manual' },
                    { data: 'berita_acara', name: 'berita_acara' },

                    { data: 'sumber_dana', name: 'sumber_dana' },
                    { data: 'tarif_penyesuaian', name: 'tarif_penyesuaian' },
                    { data: 'ket_revisi', name: 'ket_revisi' },
                    { data: 'ket_posisi', name: 'master_posisi.ket_posisi' },
                    { data: 'status1', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-warning waves-effect waves-light btn-sm" onclick='ubah(${JSON.stringify(row)})'> <i class="fa fa-pen mr-1"></i> <span>Ubah Data</span></button>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });


        $( function() {
        $( "#from_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });

        $( function() {
        $( "#from_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });

        document.querySelector(".third").addEventListener('click', function(){
        Swal.fire("Data Yang Anda Input Sedang Diproses", "Perlu Diperhatikan Export PDF Akan Memakan Waktu Lebih Lama Dikarenakan Data Yang Sangat Banyak", "success");
        });

        
        function fototruk(foto_edit) {
            let urlFoto = '/foto/truk/'+foto_edit
            $('#modal_tampak').modal('show');
            $.ajax({url: urlFoto})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Truk',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }


        function fotospta(foto_spta_edit) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('/foto/spta') }}/${foto_spta_edit}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Spta',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }


        function fototimbang(foto_timbang_edit) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('foto/timbang') }}/${foto_timbang_edit}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Timbang',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }


        function ubah(row) {
            $('#ubah_id').val(row.tma_id);
            $('#ubah_nopol').val(row.nopol);
            $('#ubah_spta').val(row.nomor_spta);
            $('#ubah_statanam').val(row.statustanam_id);
            $('#ubah_petak').val('');
            $('#ubah_posisi').val(row.posisi_id);
            $('#ubah_sumberdana').val(row.sumber_dana);
            $('#ubah_hasiltimbang').val(row.hasil_timbang);
            $('#modal_ubah').modal({backdrop: 'static', show: true});
        }

        
        $('#form_ubah').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url:$(this).attr("action"),
                data:new FormData(this),
                type:$(this).attr("method"),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(this).find(':submit').prop('disabled', true);
                },
                complete:function() {
                    $(this).find(':submit').prop('disabled', false);
                },
                success:function(data) {
                    tabel.ajax.reload();
                    if (data.success) {
                        $("#modal_ubah").modal('hide');
                        Swal.fire({ title: "Ubah Data!", text: "Ubah Data Berhasil.", type: "success" });
                    } else {
                        Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
                }
            });
        });


    </script>
@endsection

<!-- test -->
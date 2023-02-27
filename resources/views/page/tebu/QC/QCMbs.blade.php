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
        <li class="breadcrumb-item active"></li>
    </ol>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Data </h4><br>
                        <p class="sub-header"></p>
                        <div class="grupExport mb-3">
                            <span class="card-text">
                                <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_export_excel" data-backdrop="static"><i class="fa fa-exclamation-circle"></i> Export Excel</button>
                            </span>

                            <span class="card-text ml-1">
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#modal_export_pdf" data-backdrop="static"><i class="fa fa-exclamation-circle"></i> Export PDF</button>
                            </span>
                        </div>

                    <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Nopol</th>
                                <th>Foto Nopol</th>
                                <th>Foto Tebu</th>
                                <th>Foto Lasahan</th>
                                <th>Foto Set.Pengisian</th>
                                <th>Kebun - Afdeling</th>
                                <th>Status Tanam</th>
                                <th>Petak Tebang</th>
                                <th>Varietas</th>
                                <th>Tebang Muat</th>
                                <th>Nama Op.Graber</th>
                                <th>Brix</th>
                                <th>Umur</th>
                                <th>Daduk</th>
                                <th>Tanah</th>
                                <th>Akar</th>
                                <th>Pucuk</th>
                                <th>Sogolan</th>
                                <th>Benda Lain</th>
                                <th>Lama Lasahan</th>
                                <th>Status Tebu</th>
                                <th>Status Posisi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> 

    <div id="modal_export_excel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_export" method="post" action="{{ route('QCMBSExcel') }}" >
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

                    @if($jabatan == "ADMIN KEBUN" || $jabatan == "MANAJER" )
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
                    @if($jabatan != "ADMIN KEBUN" && $jabatan != "MANAJER" )
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun" name="kebun_id[]" multiple>
                                    <option value="" disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}"> {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end row -->
    <!-- sorting data export pdf -->
    <div id="modal_export_pdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_export_pdf" method="post" action="{{ route('QCMBSPdf') }}" target="_blank">
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
                    @if($jabatan == "ADMIN KEBUN" || $jabatan == "MANAJER" )
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
                    @if($jabatan != "ADMIN KEBUN" && $jabatan != "MANAJER" )
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun_p" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun_p" name="kebun_id[]" multiple>
                                    <option value="" disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}" > {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light third">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->


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

@section('customJS')
    <script type="text/javascript">

        var tabel;

        $(document).ready(function() {

            $('#pilih_posisi').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_posisi').select2({width: '100%'});
            $('#pilih_kebun').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_kebun').select2({width: '100%'});
            $('#pilih_kebun_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_kebun_p').select2({width: '100%'});
            $('#pilih_posisi_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_posisi_p').select2({width: '100%'});

            tabel = $('#table').DataTable({
                processing: false,
                serverSide: true,
                ajax : {
                    'url' : '{{ url('tebu/qcmbs/get') }}',
                    'type' : 'post',
                    'data' : {_token: "{{csrf_token()}}"}
                },
                order: [],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user_username', name: 'user_username'},
                    { data: 'nopol', name: 'nopol'},
                    { data: 'foto_nopol', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="FotoNopol(${row.mbs_id})">Foto Nopol</button>`;
                        },
                        searchable: false
                    },
                    { data: 'foto_tebu', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="FotoTebu(${row.mbs_id})">Foto Tebu</button>`;
                        },
                        searchable: false
                    },
                    { data: 'foto_lasahan', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="FotoLasahan(${row.mbs_id})">Foto Lasahan</button>`;
                        },
                        searchable: false
                    },
                    { data: 'foto_setengah_pengisian', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="FotoPengisian(${row.mbs_id})">Foto Set.Pengisian</button>`;
                        },
                        searchable: false
                    },
                    { data: 'kebun_afdeling', name: 'kebun_afdeling'},
                    { data: 'petak_tanam', name: 'petak_tanam'},
                    { data: 'status_tanam', name: 'status_tanam'},
                    { data: 'varietas', name: 'varietas'},
                    { data: 'tebang_muat', name: 'tebang_muat'},
                    { data: 'operator_grabber', name: 'operator_grabber'},
                    { data: 'brix', name: 'brix'},
                    { data: 'umur', name: 'umur'},
                    { data: 'daduk', "render": function ( data, type, row ) 
                        
                        {
                            if(data == 1){
                                return `Ya`;
                            }else{
                                return `Tidak`;
                            }
                        },
                        searchable: false
                    },
                    { data: 'tanah', "render": function ( data, type, row ) 
                        
                        {
                            if(data == 1){
                                return `Ya`;
                            }else{
                                return `Tidak`;
                            }
                        },
                        searchable: false
                    },
                    { data: 'akar', "render": function ( data, type, row ) 
                        
                        {
                            if(data == 1){
                                return `Ya`;
                            }else{
                                return `Tidak`;
                            }
                        },
                        searchable: false
                    },
                    { data: 'pucuk', "render": function ( data, type, row ) 
                        
                        {
                            if(data == 1){
                                return `Ya`;
                            }else{
                                return `Tidak`;
                            }
                        },
                        searchable: false
                    },
                    { data: 'sogolan', "render": function ( data, type, row ) 
                        
                        {
                            if(data == 1){
                                return `Ya`;
                            }else{
                                return `Tidak`;
                            }
                        },
                        searchable: false
                    },
                    { data: 'benda_lain', "render": function ( data, type, row ) 
                        
                        {
                            if(data == 1){
                                return `Ya`;
                            }else{
                                return `Tidak`;
                            }
                        },
                        searchable: false
                    },
                    { data: 'waktu_lasahan', name: 'waktu_lasahan'},
                    { data: 'status', name: 'status'},

                    { data: 'ket_posisi', name: 'ket_posisi'},
                    // { data: 'data', "render": function ( data, type, row ) 
                    //     {
                    //         return `<button type="button" class="btn btn-warning waves-effect waves-light btn-sm" onclick='history_show(${(row.key_loses)})'> <i class="fa fa-pen mr-1"></i> <span>Tampilkan Data</span></button>`;
                    //     },
                    //     orderable: false,
                    //     searchable: false
                    // },
                    
                ]
            });
        });



        function FotoNopol(foto_nopol) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('/foto/mbs/nopol') }}/${foto_nopol}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Nopol',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }


        function FotoTebu(foto_tebu) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('foto/mbs/tebu') }}/${foto_tebu}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Tebu',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }

        function FotoLasahan(foto_lasahan) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('foto/mbs/lasahan') }}/${foto_lasahan}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Lasahan',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }


        function FotoPengisian(foto_setengah_pengisian) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('foto/mbs/pengisian') }}/${foto_setengah_pengisian}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Pengisian',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }

        // function ubah(row) {
        //     $('#ubah_id').val(row.unit_id);
        //     $('#ubah_nama').val(row.unit_nama);
        //     $('#ubah_keterangan').val(row.unit_keterangan);
        //     $('#ubah_tipe').val(row.unit_tipe_id);
        //     $('#ubah_tipe').select2({dropdownParent: $("#modal_ubah")}).trigger('change');
        //     $('#modal_ubah').modal({backdrop: 'static', show: true});
        // }

        // function ubahStatus(id, status) {
        //     Swal.fire({
        //         title: "Apakah Anda Yakin?",
        //         text: "Mengubah Status Menjadi "+(status == 1 ? "Tidak Aktif" : "Aktif"),
        //         type: "warning",
        //         showCancelButton: true,
        //         cancelButtonText: "Tidak",
        //         confirmButtonText: "Iya",
        //         confirmButtonClass: "btn btn-success width-xs ml-2 mt-2",
        //         cancelButtonClass: "btn btn-danger width-xs mt-2",
        //         buttonsStyling: false,
        //         reverseButtons: true,
        //         allowOutsideClick: false,
        //         preConfirm: () => {
        //             return new Promise(function (resolve) {
        //                 $.ajax({
        //                     url: `{!! url('master/unit/status') !!}/${id}`,
        //                     type: 'put',
        //                     data: {'status': status},
        //                     dataType: 'json',
        //                     success: function (data) {
        //                         console.log(data);
        //                         if (data.success) {
        //                             tabel.ajax.reload();
        //                             resolve("success");
        //                         } else {
        //                             resolve("failure");
        //                         }
        //                     },
        //                     error: function (xhr, status, error) {
        //                         resolve("error");
        //                     },
        //                 });
        //             })
        //         },
        //     }).then(function (result) {
        //         if (result.value) {
        //             result.value == "success" ? Swal.fire({ title: "Ubah Status!", text: "Ubah Status Berhasil.", type: "success" })
        //                 : Swal.fire({ title: "Error", text: "Ubah Status Gagal", type: "error" });
        //         } else {
        //             result.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Batal", text: "Ubah Status Batal", type: "error" });
        //         }
        //     });
        // }

        // $('#form_tambah').submit(function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url:$(this).attr("action"),
        //         data:new FormData(this),
        //         type:$(this).attr("method"),
        //         dataType: 'json',
        //         processData: false,
        //         contentType: false,
        //         beforeSend: function() {
        //             $(this).find(':submit').prop('disabled', true);
        //         },
        //         complete:function() {
        //             $(this).find(':submit').prop('disabled', false);
        //         },
        //         success:function(data) {
        //             tabel.ajax.reload();
        //             if (data.success) {
        //                 $("#modal_tambah").modal('hide');
        //                 Swal.fire({ title: "Tambah Data!", text: "Tambah Data Berhasil.", type: "success" });
        //             } else {
        //                 Swal.fire({ title: "Error", text: "Tambah Data Gagal", type: "error" });
        //             }
        //         },
        //         error: function (data) {
        //             console.log('Error:', data);
        //             Swal.fire({ title: "Error", text: "Tambah Data Gagal", type: "error" });
        //         }
        //     });
        // });

        // $('#form_ubah').submit(function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url:$(this).attr("action"),
        //         data:new FormData(this),
        //         type:$(this).attr("method"),
        //         dataType: 'json',
        //         processData: false,
        //         contentType: false,
        //         beforeSend: function() {
        //             $(this).find(':submit').prop('disabled', true);
        //         },
        //         complete:function() {
        //             $(this).find(':submit').prop('disabled', false);
        //         },
        //         success:function(data) {
        //             tabel.ajax.reload();
        //             if (data.success) {
        //                 $("#modal_ubah").modal('hide');
        //                 Swal.fire({ title: "Ubah Data!", text: "Ubah Data Berhasil.", type: "success" });
        //             } else {
        //                 Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
        //             }
        //         },
        //         error: function (data) {
        //             console.log('Error:', data);
        //             Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
        //         }
        //     });
        // });


    </script>
@endsection
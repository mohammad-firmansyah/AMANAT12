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
                    <p class="card-text">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_tambah" data-backdrop="static"><i class="fa fa-plus mr-1"></i> Tambah Data</button>
                    </p>

                    <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No.</th>
                                <th>Nopol</th>
                                <th>Nomor SPTA</th>
                                <th>Timbang Kebun / Estimasi</th>
                                <th>Timbang Kebun / Realisasi</th>
                                <th>Kebun Afdeling</th>
                                <th>Status Tanam</th>
                                <th>PG Tujuan</th>
                                <th>Tebang Muat</th>
                                <th>Foto Truk</th>
                                <th>Foto SPTA</th>
                                <th>Foto Nota Timbang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
               <!-- <form id="form_tambah" method="post" action="{!! url('master/unit/store') !!}">-->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_nama" class="control-label">Nama</label>
                                    <input type="text" class="form-control" id="tambah_nama" name="nama" placeholder="Nama Unit" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_tipe" class="control-label">Tipe Unit</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="tambah_keterangan" class="control-label">Keterangan</label>
                                    <textarea class="form-control" id="tambah_keterangan" name="keterangan" placeholder="Keterangan"></textarea>
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

@section('customJS')
    <script type="text/javascript">

        var tabel;

        $(document).ready(function() {

            $('#tambah_tipe').select2({dropdownParent: $("#modal_tambah")});

            tabel = $('#table').DataTable({
                processing: false,
                serverSide: true,
                ajax: '{!! url('tebu/petugaspg/get') !!}',
                order: [],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nopol', name: 'nopol' },
                    { data: 'nomor_spta', name: 'nomor_spta' },
                    { data: 'estimasi_berat', name: 'master_timbangkebun.estmasi_berat' },
                    { data: 'hasil_timbang', name: 'hasil_timbang'},
                    { data: 'kebun_afdeling', name: 'kebun_afdeling' },
                    { data: 'status_tanam', name: 'master_statustanam.status_tanam' },
                    { data: 'pg_tujuan', name: 'pg_tujuan' },
                    { data: 'tebmuat_askep', name: 'tebmuat_askep'},
                    { data: 'foto', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="tampak('${row.id}')">tampilkan foto</button>`;
                        },
                        searchable: false
                    },
                    { data: 'foto_spta', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="tampak('${row.tma_id}')">tampilkan foto</button>`;
                        },
                        searchable: false
                    },
                    { data: 'foto_timbang', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="tampak('${row.tma_id}')">tampilkan foto</button>`;
                        },
                        searchable: false
                    },
                    { data: 'posisi_id', "render": function ( data, type, row ) 
                        {
                            if (data == 3) {
                                return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="ubahStatus(${row.tma_id}, ${data})">Pending Data SPTA</button>`;
                            }
                            if (data == 2) {
                                return `<button ty  pe="button" class="btn btn-success waves-effect waves-light btn-sm">Data Reject</button>`;
                            }
                             else {
                                return `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatus(${row.tma_id}, ${data})">Reject SPTA</button>`;
                            }
                        },
                        searchable: false
                    },
                ]
            });
        });

        function ubah(row) {
            $('#ubah_id').val(row.unit_id);
            $('#ubah_nama').val(row.unit_nama);
            $('#ubah_keterangan').val(row.unit_keterangan);
            $('#ubah_tipe').val(row.unit_tipe_id);
            $('#ubah_tipe').select2({dropdownParent: $("#modal_ubah")}).trigger('change');
            $('#modal_ubah').modal({backdrop: 'static', show: true});
        }

        function ubahStatus(id, status) {
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Mengubah Status Menjadi "+(status == 1 ? "Tidak Aktif" : "Aktif"),
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Tidak",
                confirmButtonText: "Iya",
                confirmButtonClass: "btn btn-success width-xs ml-2 mt-2",
                cancelButtonClass: "btn btn-danger width-xs mt-2",
                buttonsStyling: false,
                reverseButtons: true,
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise(function (resolve) {
                        $.ajax({
                            url: `{!! url('master/unit/status') !!}/${id}`,
                            type: 'put',
                            data: {'status': status},
                            dataType: 'json',
                            success: function (data) {
                                console.log(data);
                                if (data.success) {
                                    tabel.ajax.reload();
                                    resolve("success");
                                } else {
                                    resolve("failure");
                                }
                            },
                            error: function (xhr, status, error) {
                                resolve("error");
                            },
                        });
                    })
                },
            }).then(function (result) {
                if (result.value) {
                    result.value == "success" ? Swal.fire({ title: "Ubah Status!", text: "Ubah Status Berhasil.", type: "success" })
                        : Swal.fire({ title: "Error", text: "Ubah Status Gagal", type: "error" });
                } else {
                    result.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Batal", text: "Ubah Status Batal", type: "error" });
                }
            });
        }

        $('#form_tambah').submit(function(event) {
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
                        $("#modal_tambah").modal('hide');
                        Swal.fire({ title: "Tambah Data!", text: "Tambah Data Berhasil.", type: "success" });
                    } else {
                        Swal.fire({ title: "Error", text: "Tambah Data Gagal", type: "error" });
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire({ title: "Error", text: "Tambah Data Gagal", type: "error" });
                }
            });
        });

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